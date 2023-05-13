import git
import os
import shutil

git_url = "https://gitlab.com/23-ucr-grupo04/api.git"
repo_dir = "repoxx"
branch = "main"

if os.path.exists(repo_dir):
    shutil.rmtree(repo_dir)

r = git.Repo.clone_from(git_url, repo_dir, branch=branch, recursive=True)
