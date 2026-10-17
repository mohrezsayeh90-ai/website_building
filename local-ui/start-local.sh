#!/usr/bin/env bash
set -euo pipefail
cd -- "$(dirname -- "$0")"
if command -v php >/dev/null 2>&1; then
  exec php -n -S 127.0.0.1:8033 -t public router.php
fi
runtime=/workspace/php-runtime/root
if [[ -x "$runtime/usr/bin/php8.4" ]]; then
  export LD_LIBRARY_PATH="$runtime/usr/lib/x86_64-linux-gnu${LD_LIBRARY_PATH:+:$LD_LIBRARY_PATH}"
  exec "$runtime/usr/bin/php8.4" -n -S 127.0.0.1:8033 -t public router.php
fi
echo 'PHP 8.2 or later is required.' >&2
exit 1
