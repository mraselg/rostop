# Automated Git Commit & Push Rule

## Directive
After completing every feature, redesign, bug fix, or significant update requested by the user:
1. Use Git binary at `C:\Program Files\Git\cmd\git.exe` (or `git` if available in PATH).
2. Stage all changed project files (`git add .`).
3. Create a concise, meaningful commit message summarizing the changes.
4. Push to remote `origin main` (`https://github.com/mraselg/rostop.git`).
5. Inform the user of the commit hash and push status.
