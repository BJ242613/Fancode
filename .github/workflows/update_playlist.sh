#!/bin/bash

# Fetch the M3U playlist from the source URL
wget -q -O playlist.m3u https://rattling-glazes.000webhostapp.com/Bjtech_fancode.m3u

# Configure Git settings
git config --local user.email "action@github.com"
git config --local user.name "GitHub Action"

# Add, commit, and push the updated playlist
git add playlist.m3u
git commit -m "Update playlist [skip ci]"
git push
