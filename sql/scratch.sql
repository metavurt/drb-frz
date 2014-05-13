SELECT SUM(bnp_stats.g1 + bnp_stats.hnd) AS g1Total
		FROM bnp_teams
			JOIN bnp_players
				ON bnp_players.tid = bnp_teams.tid
			JOIN bnp_stats
				ON bnp_stats.pid = bnp_players.pid
		WHERE bnp_teams.tid = 1 AND bnp_stats.wid = 1



SELECT bnp_teams.tid, tname, SUM(twins) as wins, sum(tloss) as loss,
FORMAT(100 * SUM(twins)/(SUM(twins) + SUM(tloss)), 2) as pcnt
FROM bnp_teams
JOIN bnp_points
ON bnp_points.tid = bnp_teams.tid
GROUP BY tid
ORDER BY wins DESC

SELECT bnp_players.pid, pname, SUM(g1 + g2 + g3) as tpins, COUNT(wid)*3 as gms,
ROUND(SUM(g1 + g2 + g3)/(COUNT(wid)*3), 0) as avgs,
ROUND(SUM(hnd)/COUNT(wid), 0) as hnd
FROM bnp_players
JOIN bnp_stats
ON bnp_stats.pid = bnp_players.pid
GROUP BY pid


SELECT bnp_teams.tid, tname, SUM(twins) as wins, sum(tloss) as loss,
FORMAT(100 * SUM(twins)/(SUM(twins) + SUM(tloss)), 2) as pcnt,
SUM(tpins) as tpins
FROM bnp_teams
JOIN bnp_points
ON bnp_points.tid = bnp_teams.tid
GROUP BY tid
ORDER BY wins DESC, tpins DESC

SELECT bnp_players.pid, pname, SUM(g1 + g2 + g3) as tpins, COUNT(wid)*3 as gms,
ROUND(SUM(g1 + g2 + g3)/(COUNT(wid)*3), 0) as avgs,
ROUND(SUM(hnd)/COUNT(wid), 0) as hnd
FROM bnp_players
JOIN bnp_stats
ON bnp_stats.pid = bnp_players.pid
WHERE bnp_players.tid = $teamID
GROUP BY pid