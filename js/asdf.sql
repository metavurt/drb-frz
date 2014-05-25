
update bnp_points set tpins='2144' where tid='1' and wid='6';




('SELECT tname, bnp_players.pid as pid, pname, g1, g2, g3,
					SUM(g1 + g2 + g3) as tp,
                    ROUND( SUM(g1 + g2 + g3) + SUM(hnd)/COUNT(wid), 0) as tph,
					ROUND(SUM(g1 + g2 + g3)/(COUNT(wid)*3), 0) as avrg,
					ROUND(SUM(hnd)/COUNT(wid), 0) as h
					FROM bnp_teams, bnp_players
					JOIN bnp_stats
					ON bnp_stats.pid = bnp_players.pid
					WHERE bnp_teams.tid = '.$team.' AND bnp_players.tid = '.$team.'
					AND bnp_stats.wid = '.$wk.'
					GROUP BY pid');

