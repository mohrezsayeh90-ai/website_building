#!/usr/bin/env bash
set -euo pipefail
runtime=/workspace/php-runtime
if command -v php >/dev/null 2>&1 && php -n -r 'exit(PHP_VERSION_ID >= 80200 ? 0 : 1);'; then
  exit 0
fi
if [[ -x "$runtime/root/usr/bin/php8.4" ]] && LD_LIBRARY_PATH="$runtime/root/usr/lib/x86_64-linux-gnu" "$runtime/root/usr/bin/php8.4" -n -r 'exit(PHP_VERSION_ID >= 80200 ? 0 : 1);'; then
  exit 0
fi
# Unprivileged Debian 13 setup using signed Debian metadata and checked packages.
mkdir -p "$runtime/apt/lists/partial" "$runtime/apt/cache/archives/partial" "$runtime/apt/parts" "$runtime/apt/sourceparts" "$runtime/root"
cat > "$runtime/apt/sources.list" <<'EOF'
deb [signed-by=/usr/share/keyrings/debian-archive-keyring.gpg] https://deb.debian.org/debian trixie main
EOF
cat > "$runtime/apt/apt.conf" <<'EOF'
Dir::Etc::parts "/workspace/php-runtime/apt/parts";
Dir::Etc::main "-";
Dir::Etc::sourcelist "/workspace/php-runtime/apt/sources.list";
Dir::Etc::sourceparts "/workspace/php-runtime/apt/sourceparts";
Dir::State::lists "/workspace/php-runtime/apt/lists";
Dir::Cache::archives "/workspace/php-runtime/apt/cache/archives";
APT::Get::List-Cleanup "0";
EOF
cd "$runtime"
export APT_CONFIG="$runtime/apt/apt.conf"
/usr/bin/apt-get update
/usr/bin/apt-get download php8.4-cli php8.4-common libargon2-1
for package in php8.4-cli_*.deb php8.4-common_*.deb libargon2-1_*.deb; do
  dpkg-deb -x "$package" "$runtime/root"
done
LD_LIBRARY_PATH="$runtime/root/usr/lib/x86_64-linux-gnu" "$runtime/root/usr/bin/php8.4" -n -v
