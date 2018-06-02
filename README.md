# AFTT reverse engineered API
This api allows you to use the AFTT's API easier. It uses standard REST requests. The quality of the data coming from this API is leaving something to be desired.

# Routes available

## Calendar
Calendar of a club

	/calendrier/club/{uniqueDivisionIndex}

Calendar of a division

	/calendrier/division/{uniqueDivisionIndex}

## Club details
Infos

	/club/{uniqueClubIndex}/infos

Members

	/club/{uniqueClubIndex}/membres

Pratical infos

	/club/{uniqueClubIndex}/pratiques

Calendar

	/club/{uniqueClubIndex}/calendrier

List of strength

	/club/{uniqueClubIndex}/force

## Results
Results of a division a given week number

	/resultats/division/{division}/{jour}

Match details

	/resultats/match/{uniqueMatchIndex}

## Ranking
Get ranking of a division

	/classements/{divisionUniqueIndex}/{weekNumber}

## Player
Get victories of a player

	/joueur/{uniquePlayerIndex}/victoires

Get defeats of a player

	/joueur/{uniquePlayerIndex}/detaites

Get info

	/joueur/{uniquePlayerIndex}/infos

## Misc
Retrieve all clubs

	/clubs
Retrieve all divisions

	/divisions
Current week number

	/journee
# Install the Application

* Point your virtual host document root to your new application's `public/` directory.
* Ensure `logs/` is web writeable.

To run the application in development, you can also run this command. 

	php composer.phar start

Run this command to run the test suite

	php composer.phar test

That's it! Now go build something cool.
