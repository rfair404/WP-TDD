#!/usr/bin/env bash
apt-get update && apt-get install subversion mysql-client
rm -rf /tmp/wordpress-tests-lib
rm -rf /tmp/wordpress