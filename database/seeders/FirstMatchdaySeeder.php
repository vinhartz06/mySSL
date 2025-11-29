<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\GameMatch;
use App\Models\Standing;

class FirstMatchdaySeeder extends Seeder
{
    public function run(): void
    {
        $timestamp = now();

        // Clear existing data
        DB::table('matches')->delete();
        DB::table('lineups')->delete();
        DB::table('stats')->delete();
        DB::table('standings')->delete();

        // Create matches for first matchday (August 2025)
        $matches = [
            [
                'home_club_id' => 5,
                'away_club_id' => 1,
                'match_date' => '2025-08-15 15:00:00',
                'venue' => 'FIKOM Stadium',
                'status' => 'fulltime',
                'home_score' => 3,
                'away_score' => 1,
                'home_shots' => 15,
                'away_shots' => 8,
                'home_shots_on_target' => 7,
                'away_shots_on_target' => 3,
                'home_offsides' => 2,
                'away_offsides' => 1,
                'home_corners' => 6,
                'away_corners' => 3,
                'home_possession' => 58.50,
                'away_possession' => 41.50,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'home_club_id' => 2,
                'away_club_id' => 3,
                'match_date' => '2025-08-15 17:30:00',
                'venue' => 'FHK Arena',
                'status' => 'fulltime',
                'home_score' => 2,
                'away_score' => 2,
                'home_shots' => 12,
                'away_shots' => 10,
                'home_shots_on_target' => 5,
                'away_shots_on_target' => 4,
                'home_offsides' => 3,
                'away_offsides' => 2,
                'home_corners' => 5,
                'away_corners' => 4,
                'home_possession' => 52.0,
                'away_possession' => 48.0,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'home_club_id' => 4,
                'away_club_id' => 6,
                'match_date' => '2025-08-16 15:00:00',
                'venue' => 'FPSI Ground',
                'status' => 'fulltime',
                'home_score' => 1,
                'away_score' => 0,
                'home_shots' => 9,
                'away_shots' => 11,
                'home_shots_on_target' => 4,
                'away_shots_on_target' => 2,
                'home_offsides' => 1,
                'away_offsides' => 4,
                'home_corners' => 3,
                'away_corners' => 7,
                'home_possession' => 45.0,
                'away_possession' => 55.0,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'home_club_id' => 7,
                'away_club_id' => 8,
                'match_date' => '2025-08-16 17:30:00',
                'venue' => 'FAD Stadium',
                'status' => 'fulltime',
                'home_score' => 0,
                'away_score' => 2,
                'home_shots' => 6,
                'away_shots' => 14,
                'home_shots_on_target' => 2,
                'away_shots_on_target' => 6,
                'home_offsides' => 2,
                'away_offsides' => 1,
                'home_corners' => 2,
                'away_corners' => 8,
                'home_possession' => 40.0,
                'away_possession' => 60.0,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'home_club_id' => 9,
                'away_club_id' => 10,
                'match_date' => '2025-08-17 15:00:00',
                'venue' => 'FTP Arena',
                'status' => 'fulltime',
                'home_score' => 1,
                'away_score' => 1,
                'home_shots' => 10,
                'away_shots' => 9,
                'home_shots_on_target' => 3,
                'away_shots_on_target' => 4,
                'home_offsides' => 1,
                'away_offsides' => 2,
                'home_corners' => 4,
                'away_corners' => 5,
                'home_possession' => 49.0,
                'away_possession' => 51.0,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
        ];

        $matchIds = [];
        foreach ($matches as $match) {
            $matchIds[] = DB::table('matches')->insertGetId($match);
        }

        $this->createMatchData($matchIds[0], 5, 1);
        $this->createMatchData($matchIds[1], 2, 3);
        $this->createMatchData($matchIds[2], 4, 6);
        $this->createMatchData($matchIds[3], 7, 8);
        $this->createMatchData($matchIds[4], 9, 10);

        $this->createStandingsFromMatches();
    }

    private function createMatchData($matchId, $homeClubId, $awayClubId)
    {
        $timestamp = now();

        $homePlayers = DB::table('players')->where('club_id', $homeClubId)->orderBy('id')->get();
        $awayPlayers = DB::table('players')->where('club_id', $awayClubId)->orderBy('id')->get();

        $match = DB::table('matches')->where('id', $matchId)->first();
        $homeScore = $match->home_score;
        $awayScore = $match->away_score;

        // FIXED: starting lineup based on ID % 20
        $startingPlayerMods = [1, 4, 5, 6, 7, 10, 11, 12, 16, 17, 18];

        $lineups = [];
        $stats = [];

        $this->createTeamLineups($matchId, $homePlayers, $startingPlayerMods, $lineups, $stats, $homeScore, $awayScore);
        $this->createTeamLineups($matchId, $awayPlayers, $startingPlayerMods, $lineups, $stats, $awayScore, $homeScore);

        DB::table('lineups')->insert($lineups);
        DB::table('stats')->insert($stats);
    }

    private function createTeamLineups($matchId, $players, $startingPlayerMods, &$lineups, &$stats, $teamScore, $opponentScore)
    {
        $timestamp = now();
        $won = $teamScore > $opponentScore;
        $draw = $teamScore == $opponentScore;

        // FIXED: Select starters by player ID % 20
        foreach ($players as $player) {
            $isStarter = in_array($player->id % 20, $startingPlayerMods);
            
            $lineups[] = [
                'match_id' => $matchId,
                'player_id' => $player->id,
                'role' => $isStarter ? 'start' : 'sub',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ];

            // Only starters get stats, they all play 0-90
            if ($isStarter) {
                $stats[] = $this->generatePlayerStats($matchId, $player, $teamScore, $won, $draw, true, 0, 90);
            }
        }
    }

    private function generatePlayerStats($matchId, $player, $teamScore, $won, $draw, $isStarter, $startMinute = 0, $endMinute = 90)
    {
        $timestamp = now();

        $isGoalkeeper = $player->position === 'GK';
        $isDefender = $player->position === 'DF';
        $isMidfielder = $player->position === 'MF';
        $isForward = $player->position === 'FW';

        $minutesPlayed = $endMinute - $startMinute;

        // FIXED: Give ALL goals to player where ID % 20 == 18
        if ($player->id % 20 == 18) {
            $goals = $teamScore;
        } else {
            $goals = 0;
        }

        // KEEP assist logic untouched
        $assists = 0;
        if ($isStarter && $teamScore > 0 && $goals == 0) {
            if ($isMidfielder || $isForward) {
                $assistProbability = $won ? 0.3 : ($draw ? 0.15 : 0.08);
                if (rand(1, 100) <= ($assistProbability * 100)) {
                    $assists = 1;
                }
            }
        }

        $tackles = $isDefender ? rand(2, 6) : ($isMidfielder ? rand(1, 4) : ($isForward ? rand(0, 2) : 0));
        $interceptions = $isDefender ? rand(3, 7) : ($isMidfielder ? rand(2, 5) : 0);
        $clearances = $isDefender ? rand(4, 9) : ($isMidfielder ? rand(1, 3) : 0);
        $saves = $isGoalkeeper ? rand(3, 7) : 0;

        $fouls = rand(0, 3);
        $yellowCards = rand(1, 100) <= 15 ? 1 : 0;
        $redCards = rand(1, 100) <= 3 ? 1 : 0;

        $perfBonus = $won ? 10 : ($draw ? 5 : 0);

        return [
            'match_id' => $matchId,
            'player_id' => $player->id,
            'start_minute' => $startMinute,
            'end_minute' => $endMinute,
            'goals' => $goals,
            'assists' => $assists,
            'interceptions' => $interceptions,
            'clearances' => $clearances,
            'tackles' => $tackles,
            'saves' => $saves,
            'fouls' => $fouls,
            'yellow_cards' => $yellowCards,
            'red_cards' => $redCards,
            'succ_passes' => rand(55 + $perfBonus, 75 + $perfBonus),
            'succ_ground_duels' => rand(35 + $perfBonus, 55 + $perfBonus),
            'succ_aerial_duels' => rand(30 + $perfBonus, 50 + $perfBonus),
            'succ_dribbles' => rand(25 + $perfBonus, 45 + $perfBonus),
            'created_at' => $timestamp,
            'updated_at' => $timestamp
        ];
    }

    private function createStandingsFromMatches()
    {
        $timestamp = now();

        $clubs = DB::table('clubs')->get();
        $standings = [];

        foreach ($clubs as $club) {
            $standings[$club->id] = [
                'club_id' => $club->id,
                'played' => 0,
                'won' => 0,
                'draw' => 0,
                'lost' => 0,
                'goals_for' => 0,
                'goals_against' => 0,
                'goal_diff' => 0,
                'points' => 0,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ];
        }

        $matches = DB::table('matches')->where('status', 'fulltime')->get();

        foreach ($matches as $match) {
            $home = $match->home_club_id;
            $away = $match->away_club_id;

            $standings[$home]['played']++;
            $standings[$away]['played']++;

            $standings[$home]['goals_for'] += $match->home_score;
            $standings[$home]['goals_against'] += $match->away_score;

            $standings[$away]['goals_for'] += $match->away_score;
            $standings[$away]['goals_against'] += $match->home_score;

            if ($match->home_score > $match->away_score) {
                $standings[$home]['won']++;
                $standings[$home]['points'] += 3;
                $standings[$away]['lost']++;
            } elseif ($match->away_score > $match->home_score) {
                $standings[$away]['won']++;
                $standings[$away]['points'] += 3;
                $standings[$home]['lost']++;
            } else {
                $standings[$home]['draw']++;
                $standings[$away]['draw']++;
                $standings[$home]['points']++;
                $standings[$away]['points']++;
            }
        }

        foreach ($standings as &$record) {
            $record['goal_diff'] = $record['goals_for'] - $record['goals_against'];
        }

        DB::table('standings')->insert(array_values($standings));
    }
}