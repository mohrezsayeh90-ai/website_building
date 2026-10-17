"""Build the portable ZIP without dependencies or machine-local configuration."""
from pathlib import Path
import os
import shutil
import zipfile

root = Path(__file__).resolve().parents[1]
output = root.parent / 'mehrabad-demo-20-projects.zip'
with zipfile.ZipFile(output, 'w', zipfile.ZIP_DEFLATED, compresslevel=9) as archive:
    for folder, dirs, files in os.walk(root):
        dirs[:] = sorted(d for d in dirs if d not in {'node_modules', '.git', '__pycache__'})
        for name in sorted(files):
            if name == 'local.json':
                continue
            path = Path(folder) / name
            archive.write(path, Path('14031117') / path.relative_to(root))
print(f'{output.name}: {output.stat().st_size:,} bytes')
shutil.copyfile(output, root.parent / 'mehrabad-14031117-local.zip')
