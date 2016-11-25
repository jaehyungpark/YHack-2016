#!/usr/bin/env python
import csv
with open('meteorite-landings.csv') as csvfile:
	reader = csv.DictReader(csvfile)
	for row in reader:
		print(row['name'], row['fall'], row['year'], row['GeoLocation'])

