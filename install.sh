#!/bin/bash

# -----------------------------------------------------------------------------
# Voslin Theme Installer Script - Version 1.0.0-beta
# -----------------------------------------------------------------------------
# Copyright (c) 2024 Sonic Hedgehog
# Product: Voslin Theme
# Theme Authors: L4oySt0rm and Sonic Hedgehog
# Developed for: VerleX Development
# GitHub Repository: https://github.com/Sonic-Hedgehog/Voslin-Theme
# Discord: https://discord.gg/vQCjCPJa5Z
# -----------------------------------------------------------------------------
# This installer is licensed under the MIT License.
# You can find the full license text at https://opensource.org/licenses/MIT
# -----------------------------------------------------------------------------

# Define colors
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
BOLD='\033[1m'
NC='\033[0m' # No Color

# Function to print the copyright, license, and version information
print_copyright_info() {
    echo -e "${GREEN}${BOLD}Voslin Theme Installer - Version 1.0.0-beta${NC}"
    echo -e "${YELLOW}Copyright (c) 2024 Sonic Hedgehog${NC}"
    echo -e "${BLUE}Product:${NC} Voslin Theme"
    echo -e "${BLUE}Theme Authors:${NC} L4oySt0rm and Sonic Hedgehog"
    echo -e "${BLUE}Developed for:${NC} VerleX Development"
    echo -e "${BLUE}GitHub Repository:${NC} https://github.com/Sonic-Hedgehog/Voslin-Theme"
    echo -e "${BLUE}Discord:${NC} https://discord.gg/vQCjCPJa5Z"
    echo -e "${YELLOW}---------------------------------------------------------${NC}"
    echo -e "${RED}${BOLD}This installer is licensed under the MIT License.${NC}"
    echo -e "${RED}You can find the full license text at https://opensource.org/licenses/MIT${NC}"
    echo -e "${YELLOW}---------------------------------------------------------${NC}"
    echo ""
}

# Git repository for the VOSLIN theme
REPO_URL="https://github.com/sonic-hedgehog/voslin-theme.git"

# Function to prompt the user for the paymenter directory
ask_for_paymenter_directory() {
    echo -e "${BOLD}Please enter the path to the 'paymenter' root directory:${NC}"
    read -r PAYMENTER_DIR

    # Check if the directory exists
    if [ ! -d "$PAYMENTER_DIR/themes" ]; then
        echo -e "${RED}The directory '$PAYMENTER_DIR' is not the Paymenter root folder. Please try again.${NC}"
        ask_for_paymenter_directory
    fi
    THEME_DIR="$PAYMENTER_DIR/themes/voslintheme"
}

# Function to check for Voslin theme and prompt user
check_voslin_theme() {

    # Check if the 'voslintheme' folder exists
    if [ -d "$THEME_DIR" ]; then
        # Print the warning in red
        echo -e "${RED}WARNING: A Voslin installation was found at $THEME_DIR."
        echo -e "This installation will be deleted and replaced with a new one."
        echo -e "All changes to the theme will be lost.${NC}"
        
        # Prompt the user for confirmation
        read -p "Do you want to proceed with the installation? (y/n): " choice
        
        if [[ "$choice" == "y" || "$choice" == "Y" ]]; then
            echo -e "${YELLOW}Continuing with the installation. The existing theme will be deleted.${NC}"
            rm -rf "$THEME_DIR"
            mkdir "$THEME_DIR"
        else
            echo -e "${RED}Installation aborted by the user.${NC}"
            exit 1
        fi
    else
        echo -e "${GREEN}No Voslin installation found. Proceeding with the installation.${NC}"
    fi
}

# Function to check installed versions
check_versions() {
    echo -e "${BOLD}Checking installed versions...${NC}"
    cd $PAYMENTER_DIR
    if command -v node &> /dev/null; then
        echo -e "${GREEN}Node.js Version: $(node -v)${NC}"
    else
        echo -e "${RED}Node.js is not installed.${NC}"
        install_dependencies
        return 0
    fi

    if command -v npm &> /dev/null; then
        echo -e "${GREEN}npm Version: $(npm -v)${NC}"
    else
        echo -e "${RED}npm is not installed.${NC}"
        install_dependencies
        return 0
    fi

    if npm list vite &> /dev/null; then
        echo -e "${GREEN}Vite Version: $(npm list vite --depth=0 | grep vite | awk -F@ '{print $2}')${NC}"
    else
        echo -e "${RED}Vite is not installed.${NC}"
        install_dependencies
        return 0
    fi
    cd "$SCRIPT_DIR"
}

# Function to install dependencies
install_dependencies() {
    cd $PAYMENTER_DIR
    echo -e "${YELLOW}Installing required packages...${NC}"
    sudo apt-get update
    sudo apt-get install -y git

    # Check and install Node.js and npm
    if ! command -v node &> /dev/null; then
        echo -e "${YELLOW}Node.js not found. Installing Node.js...${NC}"
        sudo apt-get install -y nodejs
    else
        echo -e "${GREEN}Node.js is already installed.${NC}"
    fi

    if ! command -v npm &> /dev/null; then
        echo -e "${YELLOW}npm not found. Installing npm...${NC}"
        sudo apt-get install -y npm
    else
        echo -e "${GREEN}npm is already installed.${NC}"
    fi

    # Check and install the Vite module
    if ! npm list vite &> /dev/null; then
        echo -e "${YELLOW}Vite not found. Installing Vite...${NC}"
        sudo npm install vite
    else
        echo -e "${GREEN}Vite is already installed.${NC}"
    fi
    cd "$SCRIPT_DIR"
}

# Function to download and install the theme
install_theme() {
    
    TMP_DIR="$SCRIPT_DIR/Installer_tmp"
    
    if [ -d "$TMP_DIR" ]; then
        echo -e "${YELLOW}${BOLD}The directory '$TMP_DIR' already exists.${NC}"
        echo -e "${RED}Deleting the existing directory '$TMP_DIR'...${NC}"
        rm -rf "$TMP_DIR"
        echo -e "${GREEN}Creating a new directory '$TMP_DIR'...${NC}"
        mkdir -p "$TMP_DIR"
        echo -e "${GREEN}The directory has been recreated successfully.${NC}"
    else
        echo -e "${BLUE}${BOLD}The directory '$TMP_DIR' does not exist. Creating it now...${NC}"
        mkdir -p "$TMP_DIR"
        echo -e "${GREEN}The directory has been created successfully.${NC}"
    fi

    # Branch selection
    echo -e "${BOLD}Which branch would you like to install? (main/dev)${NC}"
    read -r BRANCH
    if [ "$BRANCH" != "main" ] && [ "$BRANCH" != "dev" ]; then
        echo -e "${YELLOW}Invalid input. The 'main' branch will be used by default.${NC}"
        BRANCH="main"
    fi

    echo -e "${YELLOW}Downloading the Voslin-Theme from the $BRANCH branch...${NC}"
    git clone -b "$BRANCH" "$REPO_URL" "$TMP_DIR"

    # Move the contents from tmp/themes/ to /var/www/paymenter/themes
    echo -e "${YELLOW}Moving theme files to $THEME_DIR...${NC}"
    mv "$TMP_DIR/themes/"* "$PAYMENTER_DIR"/themes

    # Check if the move was successful
    if [ $? -ne 0 ]; then
        echo -e "${RED}Failed to move theme files. Exiting.${NC}"
        exit 1
    fi

    # Run the vite.js build command
    echo -e "${BLUE}Running vite.js build for voslintheme...${NC}"
    cd $PAYMENTER_DIR
    sudo node vite.js voslintheme
    
    # Confirm completion
    if [ $? -eq 0 ]; then
        echo -e "${GREEN}Installation and build completed successfully.${NC}"
    else
        echo -e "${RED}Failed to build the theme with vite.js.${NC}"
        exit 1
    fi

    # Delete the tmp directory
    echo -e "${YELLOW}Cleaning up...${NC}"
    rm -rf "$TMP_DIR"
    
    echo -e "${GREEN}Theme successfully installed!${NC}"
}

# Function to apply the theme (optional)
apply_theme() {
    echo -e "${BLUE}Applying the Voslin-Theme...${NC}"
    cd $PAYMENTER_DIR
    php artisan p:settings:change-theme voslintheme
    echo -e "${GREEN}Theme applied. Enjoy!${NC}"
}

# Main program
main() {
    SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
    clear
    print_copyright_info
    ask_for_paymenter_directory
    check_voslin_theme
    check_versions
    install_theme
    apply_theme
}

# Execute the script
main

