#!/usr/bin/env python
import subprocess
with open("output.json", "w+") as output:
	subprocess.call(["python", "./test.py"], stdout=output);
