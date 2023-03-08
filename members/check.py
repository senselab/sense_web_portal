#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import os
import json

for root, dirs, files in os.walk("."):
    for f in files:
        if f.endswith(".json") == False: continue
        path = os.path.join(root, f)
        try:
            with open(path, 'r') as f:
                json.loads(f.read())
        except json.decoder.JSONDecodeError as e:
            print(f'{path}:', e)

# vim: set tabstop=4 expandtab shiftwidth=4 softtabstop=4 number cindent fileencoding=utf-8 :
