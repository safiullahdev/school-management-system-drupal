# schoolsystem-drupal

## Push code to branch and then merge with main

### Push to branch
```
git status
On branch SMD-54-restrict-status-field-visibility-role
nothing to commit, working tree clean
```
### Merge with main
```
# 1. Go to main
git checkout main

# 2. Get latest from remote
git pull origin main

# 3. Merge your branch
git merge SMD-54-restrict-status-field-visibility-role

# 4. 
git push origin main

```


