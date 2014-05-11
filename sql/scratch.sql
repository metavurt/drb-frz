SELECT SUM(bnp_stats.g1 + bnp_stats.hnd) AS g1Total
		FROM bnp_teams
			JOIN bnp_players
				ON bnp_players.tid = bnp_teams.tid
			JOIN bnp_stats
				ON bnp_stats.pid = bnp_players.pid
		WHERE bnp_teams.tid = 1 AND bnp_stats.wid = 1



SELECT tname, bnp_teams.tid, SUM(bnp_stats.g1 + bnp_stats.hnd) AS g1,
				SUM(bnp_stats.g2 + bnp_stats.hnd) AS g2,
                SUM(bnp_stats.g3 + bnp_stats.hnd) AS g3,
                SUM(bnp_stats.g1 + bnp_stats.g2 + bnp_stats.g3 + (bnp_stats.hnd * 3)) AS TotalPins
		FROM bnp_teams
			JOIN bnp_players
            	ON bnp_players.tid = bnp_teams.tid
			JOIN bnp_stats
				ON bnp_stats.pid = bnp_players.pid
		WHERE bnp_stats.wid = 1 GROUP BY bnp_teams.tid ORDER BY TotalPins DESC