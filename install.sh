#!/usr/bin/env bash
#
# Kroxy Theme installer for Pterodactyl Panel
# Clones the theme repo and deploys it into an existing panel install.
#
# Usage:
#   sudo ./install.sh [repo_url] [branch]
#
# Examples:
#   sudo ./install.sh
#   sudo ./install.sh https://github.com/ElXora/Kroxy-Theme.git main
#
set -euo pipefail

# ------------------------------------------------------------------
# Config — edit these or pass as arguments
# ------------------------------------------------------------------
REPO_URL="${1:-https://github.com/ElXora/Kroxy-Theme.git}"
BRANCH="${2:-main}"
PANEL_DIR="/var/www/pterodactyl"
BACKUP_ROOT="/var/backups/kroxy-theme"
NODE_MAJOR="22"
TMP_DIR=""

# ------------------------------------------------------------------
# Output helpers
# ------------------------------------------------------------------
c_reset="\033[0m"; c_blue="\033[1;34m"; c_green="\033[1;32m"; c_yellow="\033[1;33m"; c_red="\033[1;31m"
log()  { echo -e "${c_blue}[*]${c_reset} $*"; }
ok()   { echo -e "${c_green}[✓]${c_reset} $*"; }
warn() { echo -e "${c_yellow}[!]${c_reset} $*"; }
err()  { echo -e "${c_red}[x]${c_reset} $*" >&2; }

cleanup() {
    if [[ -n "$TMP_DIR" && -d "$TMP_DIR" ]]; then
        rm -rf "$TMP_DIR"
    fi
}
trap cleanup EXIT

fail_with_rollback_hint() {
    err "Installation failed."
    if [[ -n "${BACKUP_PATH:-}" ]]; then
        err "Your pre-install backup is at: ${BACKUP_PATH}"
        err "Restore it with:"
        err "  sudo rm -rf ${PANEL_DIR}"
        err "  sudo cp -a ${BACKUP_PATH} ${PANEL_DIR}"
    fi
    exit 1
}
trap fail_with_rollback_hint ERR

# ------------------------------------------------------------------
# 0. Pre-flight checks
# ------------------------------------------------------------------
if [[ $EUID -ne 0 ]]; then
    err "This script must be run as root (or with sudo)."
    exit 1
fi

if [[ ! -f "${PANEL_DIR}/artisan" ]]; then
    err "No Pterodactyl install found at ${PANEL_DIR} (missing artisan file)."
    err "Set PANEL_DIR at the top of this script if your panel lives elsewhere."
    exit 1
fi

log "Panel found at ${PANEL_DIR}"
log "Theme source: ${REPO_URL} (branch: ${BRANCH})"
read -rp "Continue with install? [y/N] " CONFIRM
if [[ ! "$CONFIRM" =~ ^[Yy]$ ]]; then
    warn "Aborted."
    exit 0
fi

# ------------------------------------------------------------------
# 1. Backup the current panel before touching anything
# ------------------------------------------------------------------
mkdir -p "$BACKUP_ROOT"
TIMESTAMP="$(date +%Y%m%d-%H%M%S)"
BACKUP_PATH="${BACKUP_ROOT}/pterodactyl-${TIMESTAMP}"

log "Backing up ${PANEL_DIR} -> ${BACKUP_PATH} (this can take a minute)..."
cp -a "$PANEL_DIR" "$BACKUP_PATH"
ok "Backup complete."

warn "This backs up application files only, not the database."
warn "If you want full rollback safety, also take a DB dump now, e.g.:"
warn "  mysqldump -u root -p panel > ${BACKUP_ROOT}/panel-db-${TIMESTAMP}.sql"
read -rp "Press Enter to continue once you're ready..."

# ------------------------------------------------------------------
# 2. System dependencies
# ------------------------------------------------------------------
log "Installing system dependencies..."
apt update -y
apt install -y ca-certificates curl git gnupg unzip wget zip rsync
ok "System dependencies installed."

# ------------------------------------------------------------------
# 3. Node.js (only (re)install if the major version doesn't match)
# ------------------------------------------------------------------
CURRENT_NODE_MAJOR="0"
if command -v node >/dev/null 2>&1; then
    CURRENT_NODE_MAJOR="$(node -v | sed 's/^v//' | cut -d. -f1)"
fi

if [[ "$CURRENT_NODE_MAJOR" != "$NODE_MAJOR" ]]; then
    log "Installing Node.js ${NODE_MAJOR}.x (found v${CURRENT_NODE_MAJOR})..."
    mkdir -p /etc/apt/keyrings
    curl -fsSL https://deb.nodesource.com/gpgkey/nodesource-repo.gpg.key | gpg --dearmor -o /etc/apt/keyrings/nodesource.gpg
    echo "deb [signed-by=/etc/apt/keyrings/nodesource.gpg] https://deb.nodesource.com/node_${NODE_MAJOR}.x nodistro main" \
        > /etc/apt/sources.list.d/nodesource.list
    apt update -y
    apt install -y nodejs
    ok "Node.js $(node -v) installed."
else
    ok "Node.js $(node -v) already satisfies v${NODE_MAJOR}.x — skipping."
fi

if ! command -v yarn >/dev/null 2>&1; then
    log "Installing yarn..."
    npm i -g yarn
    ok "yarn installed."
else
    ok "yarn already installed."
fi

# ------------------------------------------------------------------
# 4. Clone the theme repo
# ------------------------------------------------------------------
TMP_DIR="$(mktemp -d)"
log "Cloning ${REPO_URL} (branch: ${BRANCH}) into ${TMP_DIR}..."
git clone --depth 1 --branch "$BRANCH" "$REPO_URL" "$TMP_DIR/repo"

SRC_DIR="$TMP_DIR/repo"
if [[ -d "$SRC_DIR/pterodactyl" ]]; then
    SRC_DIR="$SRC_DIR/pterodactyl"
fi

if [[ ! -d "$SRC_DIR" ]]; then
    err "Couldn't find theme files in the cloned repo (expected a 'pterodactyl/' folder or repo root with app/config/public/etc.)."
    exit 1
fi
ok "Theme source ready at ${SRC_DIR}"

# ------------------------------------------------------------------
# 5. Deploy theme files into the panel (merge, don't wipe existing files)
# ------------------------------------------------------------------
log "Copying theme files into ${PANEL_DIR}..."
rsync -a "$SRC_DIR"/ "$PANEL_DIR"/
ok "Theme files copied."

# ------------------------------------------------------------------
# 6. Install node dependencies
# ------------------------------------------------------------------
cd "$PANEL_DIR"
log "Running yarn install (this can take a while)..."
yarn install
ok "Dependencies installed."

# ------------------------------------------------------------------
# 7. Run the Kroxy installer
# ------------------------------------------------------------------
log "Launching the Kroxy theme installer."
log "You'll be prompted to confirm dependencies and pick a version — follow the prompts."
php artisan kroxy install

ok "Kroxy theme installation finished."
echo
ok "Backup kept at: ${BACKUP_PATH}"
echo "If anything looks wrong, restore it with:"
echo "  sudo rm -rf ${PANEL_DIR} && sudo cp -a ${BACKUP_PATH} ${PANEL_DIR}"
