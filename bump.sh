#!/bin/bash

# Check if version argument is provided
if [ -z "$1" ]; then
    echo "Please provide a version number (e.g. ./bump.sh 0.5.1)"
    exit 1
fi

NEW_VERSION=$1

# Function to update version in a file (only first occurrence)
update_version() {
    local file=$1
    echo "Updating $file..."
    # Using awk to replace only the first occurrence of version
    awk -v new_ver="$NEW_VERSION" '
        !found && /"version":/ {
            sub(/"version": *"[^"]*"/, "\"version\": \"" new_ver "\"")
            found=1
        }
        {print}
    ' "$file" > temp.json && mv temp.json "$file"
}

# Update version in each package.json
update_version "package.json"
update_version "installer/package-lock.json"
update_version "installer/package.json"
update_version "installer/package-lock.json"

echo "✅ Successfully updated version to $NEW_VERSION in all package.json files"

# Optional: Git commands to commit the changes
read -p "Do you want to commit these changes? (y/n) " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]
then
    git add package.json installer/package.json
    git commit -m "chore: bump version to $NEW_VERSION"
    echo "✅ Changes committed"

    read -p "Do you want to create a git tag? (y/n) " -n 1 -r
    echo
    if [[ $REPLY =~ ^[Yy]$ ]]
    then
        git tag -a "v$NEW_VERSION" -m "Version $NEW_VERSION"
        echo "✅ Tag v$NEW_VERSION created"

        read -p "Do you want to push the tag? (y/n) " -n 1 -r
        echo
        if [[ $REPLY =~ ^[Yy]$ ]]
        then
            git push origin "v$NEW_VERSION"
            echo "✅ Tag pushed to remote"
        fi
    fi
fi
