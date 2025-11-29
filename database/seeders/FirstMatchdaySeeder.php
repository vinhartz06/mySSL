<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\GameMatch;
use App\Models\Standing;

class FirstMatchdaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
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
            // Match 1: FIKOM (home) vs FEB (away) - FIKOM wins
            [
                'home_club_id' => 5, // FIKOM
                'away_club_id' => 1, // FEB
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
            // Match 2: FHK vs FITL
            [
                'home_club_id' => 2, // FHK
                'away_club_id' => 3, // FITL
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
            // Match 3: FPSI vs FT
            [
                'home_club_id' => 4, // FPSI
                'away_club_id' => 6, // FT
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
            // Match 4: FAD vs FLA
            [
                'home_club_id' => 7, // FAD
                'away_club_id' => 8, // FLA
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
            // Match 5: FTP vs FK
            [
                'home_club_id' => 9, // FTP
                'away_club_id' => 10, // FK
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

        // Create lineups and stats for each match
        $this->createMatchData($matchIds[0], 5, 1); // FIKOM vs FEB
        $this->createMatchData($matchIds[1], 2, 3); // FHK vs FITL
        $this->createMatchData($matchIds[2], 4, 6); // FPSI vs FT
        $this->createMatchData($matchIds[3], 7, 8); // FAD vs FLA
        $this->createMatchData($matchIds[4], 9, 10); // FTP vs FK

        // Create standings from match results
        $this->createStandingsFromMatches();
    }

    private function createMatchData($matchId, $homeClubId, $awayClubId)
    {
        $timestamp = now();

        // Get players for both clubs
        $homePlayers = DB::table('players')->where('club_id', $homeClubId)->orderBy('id')->get();
        $awayPlayers = DB::table('players')->where('club_id', $awayClubId)->orderBy('id')->get();

        // Get match result
        $match = DB::table('matches')->where('id', $matchId)->first();
        $homeScore = $match->home_score;
        $awayScore = $match->away_score;

        // Define starting player IDs for 4-3-3 formation
        $startingPlayerIds = [1, 4, 5, 6, 10, 11, 12, 16, 17, 18];
        
        // Create lineups and stats
        $lineups = [];
        $stats = [];

        // Home team lineups
        $this->createTeamLineups($matchId, $homePlayers, $startingPlayerIds, $lineups, $stats, $homeClubId, $homeScore, $awayScore, true);
        
        // Away team lineups  
        $this->createTeamLineups($matchId, $awayPlayers, $startingPlayerIds, $lineups, $stats, $awayClubId, $awayScore, $homeScore, false);

        // Insert lineups and stats
        DB::table('lineups')->insert($lineups);
        DB::table('stats')->insert($stats);
    }

    private function createTeamLineups($matchId, $players, $startingPlayerIds, &$lineups, &$stats, $clubId, $teamScore, $opponentScore, $isHome)
    {
        $timestamp = now();
        $won = $teamScore > $opponentScore;
        $draw = $teamScore == $opponentScore;

        // Create starting lineup (4-3-3 formation)
        foreach ($startingPlayerIds as $playerOrder => $playerId) {
            if (isset($players[$playerOrder])) {
                $player = $players[$playerOrder];
                
                $lineups[] = [
                    'match_id' => $matchId,
                    'player_id' => $player->id,
                    'role' => 'start',
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp
                ];

                // Create stats for starting players
                $stats[] = $this->generatePlayerStats($matchId, $player, $teamScore, $won, $draw, true, $playerOrder);
            }
        }

        // Create substitutes (remaining players)
        for ($i = count($startingPlayerIds); $i < count($players); $i++) {
            if (isset($players[$i])) {
                $player = $players[$i];
                
                $lineups[] = [
                    'match_id' => $matchId,
                    'player_id' => $player->id,
                    'role' => 'sub',
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp
                ];

                // Some substitutes get playing time
                if (rand(1, 100) <= 40) { // 40% chance sub gets playing time
                    $stats[] = $this->generatePlayerStats($matchId, $player, $teamScore, $won, $draw, false, $i);
                }
            }
        }
    }

    private function generatePlayerStats($matchId, $player, $teamScore, $won, $draw, $isStarter, $playerOrder)
    {
        $timestamp = now();
        
        $isGoalkeeper = $player->position === 'GK';
        $isDefender = $player->position === 'DF';
        $isMidfielder = $player->position === 'MF';
        $isForward = $player->position === 'FW';

        // Playing time
        $startMinute = $isStarter ? 0 : rand(60, 75);
        $endMinute = $isStarter ? 90 : 90;
        $minutesPlayed = $endMinute - $startMinute;

        // Goals - ensure goals >= assists and match final score
        $goals = 0;
        $assists = 0;

        // Distribute goals based on position and player order
        if ($isStarter && $teamScore > 0) {
            if ($isForward) {
                // Forwards more likely to score
                if ($playerOrder >= 16 && $playerOrder <= 18) { // Forward positions in 4-3-3
                    $goalProbability = $won ? 0.4 : ($draw ? 0.2 : 0.1);
                    if (rand(1, 100) <= ($goalProbability * 100)) {
                        $goals = min(rand(1, 2), $teamScore);
                    }
                }
            } elseif ($isMidfielder) {
                // Midfielders can score too
                if ($playerOrder >= 10 && $playerOrder <= 12) { // Midfield positions
                    $goalProbability = $won ? 0.2 : ($draw ? 0.1 : 0.05);
                    if (rand(1, 100) <= ($goalProbability * 100)) {
                        $goals = 1;
                    }
                }
            }
        }

        // Assists - ensure assists <= goals for the team
        if ($isStarter && $teamScore > 0 && $goals == 0) {
            if ($isMidfielder || $isForward) {
                $assistProbability = $won ? 0.3 : ($draw ? 0.15 : 0.08);
                if (rand(1, 100) <= ($assistProbability * 100)) {
                    $assists = 1;
                }
            }
        }

        // Defensive stats
        $tackles = $isDefender ? rand(2, 6) : ($isMidfielder ? rand(1, 4) : ($isForward ? rand(0, 2) : 0));
        $interceptions = $isDefender ? rand(3, 7) : ($isMidfielder ? rand(2, 5) : ($isForward ? rand(0, 1) : 0));
        $clearances = $isDefender ? rand(4, 9) : ($isMidfielder ? rand(1, 3) : 0);

        // Saves for goalkeepers
        $saves = $isGoalkeeper ? rand(3, 7) : 0;

        // Cards and fouls
        $fouls = rand(0, 3);
        $yellowCards = rand(1, 100) <= 15 ? 1 : 0;
        $redCards = rand(1, 100) <= 3 ? 1 : 0;

        // Success percentages - winning teams have better stats
        $performanceBonus = $won ? 10 : ($draw ? 5 : 0);
        
        $basePassRate = 65 + $performanceBonus;
        $succPasses = rand($basePassRate - 10, $basePassRate + 10);

        $baseGroundDuelRate = 45 + $performanceBonus;
        $succGroundDuels = rand($baseGroundDuelRate - 10, $baseGroundDuelRate + 10);

        $baseAerialDuelRate = 40 + $performanceBonus;
        $succAerialDuels = rand($baseAerialDuelRate - 10, $baseAerialDuelRate + 10);

        $baseDribbleRate = 35 + $performanceBonus;
        $succDribbles = rand($baseDribbleRate - 10, $baseDribbleRate + 10);

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
            'succ_passes' => $succPasses,
            'succ_ground_duels' => $succGroundDuels,
            'succ_aerial_duels' => $succAerialDuels,
            'succ_dribbles' => $succDribbles,
            'created_at' => $timestamp,
            'updated_at' => $timestamp
        ];
    }

    private function createStandingsFromMatches()
    {
        $timestamp = now();
        
        // Initialize standings for all clubs
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

        // Calculate standings from matches
        $matches = DB::table('matches')->where('status', 'fulltime')->get();
        
        foreach ($matches as $match) {
            $homeClubId = $match->home_club_id;
            $awayClubId = $match->away_club_id;
            $homeScore = $match->home_score;
            $awayScore = $match->away_score;

            // Update home club
            $standings[$homeClubId]['played']++;
            $standings[$homeClubId]['goals_for'] += $homeScore;
            $standings[$homeClubId]['goals_against'] += $awayScore;
            
            // Update away club
            $standings[$awayClubId]['played']++;
            $standings[$awayClubId]['goals_for'] += $awayScore;
            $standings[$awayClubId]['goals_against'] += $homeScore;

            // Determine result and update points
            if ($homeScore > $awayScore) {
                $standings[$homeClubId]['won']++;
                $standings[$homeClubId]['points'] += 3;
                $standings[$awayClubId]['lost']++;
            } elseif ($awayScore > $homeScore) {
                $standings[$awayClubId]['won']++;
                $standings[$awayClubId]['points'] += 3;
                $standings[$homeClubId]['lost']++;
            } else {
                $standings[$homeClubId]['draw']++;
                $standings[$awayClubId]['draw']++;
                $standings[$homeClubId]['points'] += 1;
                $standings[$awayClubId]['points'] += 1;
            }
        }

        // Calculate goal difference
        foreach ($standings as &$standing) {
            $standing['goal_diff'] = $standing['goals_for'] - $standing['goals_against'];
        }

        // Insert standings
        DB::table('standings')->insert(array_values($standings));
    }
}