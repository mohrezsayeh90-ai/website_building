"""Build the portable ZIP without dependencies or machine-local configuration."""
from pathlib import Path
import os
import zipfile

root = Path(__file__).resolve().parents[1]
output = root.parent / 'mehrabad-local-ui.zip'
with zipfile.ZipFile(output, 'w', zipfile.ZIP_DEFLATED, compresslevel=9) as archive:
    for folder, dirs, files in os.walk(root):
        dirs[:] = sorted(d for d in dirs if d not in {'node_modules', '.git', '__pycache__'})
        for name in sorted(files):
            if name == 'local.json':
                continue
            path = Path(folder) / name
            archive.write(path, Path('local-ui') / path.relative_to(root))
print(f'{output.name}: {output.stat().st_size:,} bytes')
