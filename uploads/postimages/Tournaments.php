<?php

	
	class Tournaments{
	
		function getTournamentList($page_number){

			$offset = ($page_number-1)*12;

			Db::query('SELECT t.tournament_id, t.tournament_name, DATE_FORMAT(t.date_of_tourney,"%m/%d/%Y") AS date_of_tourney , t.status, t.winner, t.t_status, pd.player_name FROM tournaments t LEFT JOIN player_database pd ON t.winner=pd.player_id WHERE t.subscriber_id=:subscriber_id ORDER by tournament_id DESC LIMIT '.$offset.',12');
			// 			Db::query('SELECT t.tournament_id, t.tournament_name, DATE_FORMAT(t.date_of_tourney,"%m/%d/%Y") AS date_of_tourney , t.status, t.winner, pd.player_name FROM tournaments t LEFT JOIN player_database pd ON t.winner=pd.player_id WHERE t.subscriber_id=:subscriber_id ORDER by tournament_id DESC LIMIT '.$offset.',12');
			Db::execute(array(
				':subscriber_id' => $_SESSION['user_data']['ID']
			));
			$result = Db::result();

			foreach ($result as $key => &$value) {
				$value['winner_id'] = $value['winner'];
			
				if ($value['t_status'] == 1) {
					Db::query('SELECT s.winner, p.player_name FROM split_tables as s LEFT JOIN player_database as p ON s.winner = p.player_id WHERE tournament_id=:tournament_id ORDER BY split_id DESC');
					Db::executeOne(array(
						':tournament_id' => $value['tournament_id']
					));
			
					$resultnew = Db::result();
					$winners = [];
					$playerNames = [];
			
					foreach ($resultnew as $innerArray) {
						$winners[] = $innerArray['winner'];
						$playerNames[] = $innerArray['player_name'];
					}
			
					// Assign concatenated string values back to the original array item using the reference
					$value['winner'] = implode(', ', $winners);
					$value['player_name'] = implode(', ', $playerNames);
				} else {
					$value['winner'] = $value['winner_id'];
				}			

				Db::query('SELECT COUNT(*) AS count FROM tournament_players WHERE tournament_id=:tournament_id AND player_status!=:player_status');
				Db::executeOne(array(
					':tournament_id' => $value['tournament_id'],
					':player_status' => 'outfromgame'
				));
				$result[$key]['player_count'] = Db::result()['count']; 

				if($value['status'] == 'active'){

					Db::query('SELECT table_id FROM tournament_tables WHERE tournament_id=:tournament_id');
					Db::execute(array(
						':tournament_id'=>$value['tournament_id']
					));
					$table_ids=Db::result();

					if(!$table_ids){
						$result[$key]['active_status'] = 'notsetup';
					}
					else{
						$in_array = array();

						foreach($table_ids as $key2 => $value2){

							array_push($in_array,$value2['table_id']);

						}

						$in_array_string = implode('","',$in_array);

						Db::query('SELECT COUNT(*) AS count FROM tournament_tables_players WHERE table_id IN ("'.$in_array_string.'")');
						Db::executeOne();
						$this_result = Db::result()['count'];

						if(!$this_result){
							$result[$key]['active_status'] = 'notsetup';
						}
						else{
							$result[$key]['active_status'] = 'setupok';
						}
					}
				}
			}
			unset($value);
			return $result;
		}

		//view tournament list for public
		function getTournamentViewList($page_number){

			$offset = ($page_number-1)*12;

			// Db::query('SELECT t.tournament_id, t.tournament_name, DATE_FORMAT(t.date_of_tourney,"%m/%d/%Y") AS date_of_tourney , t.status, t.winner, pd.player_name FROM tournaments t LEFT JOIN player_database pd ON t.winner=pd.player_id WHERE t.subscriber_id=:subscriber_id  AND t.status=:status AND t.is_tourney_started=:is_tourney_started ORDER by tournament_id DESC LIMIT '.$offset.',12');
			Db::query('SELECT t.tournament_id, t.tournament_name, DATE_FORMAT(t.date_of_tourney,"%m/%d/%Y") AS date_of_tourney , t.status, t.winner, pd.player_name FROM tournaments t LEFT JOIN player_database pd ON t.winner=pd.player_id WHERE t.status=:status AND t.is_tourney_started=:is_tourney_started ORDER by tournament_id DESC LIMIT '.$offset.',12');
			// 			Db::query('SELECT t.tournament_id, t.tournament_name, DATE_FORMAT(t.date_of_tourney,"%m/%d/%Y") AS date_of_tourney , t.status, t.winner, pd.player_name FROM tournaments t LEFT JOIN player_database pd ON t.winner=pd.player_id WHERE t.subscriber_id=:subscriber_id ORDER by tournament_id DESC LIMIT '.$offset.',12');
			Db::execute(array(
				':status' => 'active',
				':is_tourney_started' => 1

			));
			$result = Db::result();

			foreach($result as $key => $value){

				Db::query('SELECT COUNT(*) AS count FROM tournament_players WHERE tournament_id=:tournament_id AND player_status!=:player_status');
				Db::executeOne(array(
					':tournament_id' => $value['tournament_id'],
					':player_status' => 'outfromgame'
				));
				$result[$key]['player_count'] = Db::result()['count']; 

				if($value['status'] == 'active'){

					Db::query('SELECT table_id FROM tournament_tables WHERE tournament_id=:tournament_id');
					Db::execute(array(
						':tournament_id'=>$value['tournament_id']
					));
					$table_ids=Db::result();

					if(!$table_ids){
						$result[$key]['active_status'] = 'notsetup';
					}
					else{
						$in_array = array();

						foreach($table_ids as $key2 => $value2){

							array_push($in_array,$value2['table_id']);

						}

						$in_array_string = implode('","',$in_array);

						Db::query('SELECT COUNT(*) AS count FROM tournament_tables_players WHERE table_id IN ("'.$in_array_string.'")');
						Db::executeOne();
						$this_result = Db::result()['count'];

						if(!$this_result){
							$result[$key]['active_status'] = 'notsetup';
						}
						else{
							$result[$key]['active_status'] = 'setupok';
						}
					}
				}

			}

			return $result;
		}

		//get all active tournament count 
		function getTournamentActiveCount(){

			Db::query('SELECT COUNT(*) as count FROM tournaments');
			// 			Db::query('SELECT COUNT(*) as count FROM tournaments');
			Db::executeOne(array(
				// ':subscriber_id' => $_SESSION['user_data']['ID']
			));
			$result = Db::result()['count'];

			return $result;
		}
		///-------end--------------

		function getTournamentCount(){

			Db::query('SELECT COUNT(*) as count FROM tournaments WHERE subscriber_id=:subscriber_id');
			// 			Db::query('SELECT COUNT(*) as count FROM tournaments');
			Db::executeOne(array(
				':subscriber_id' => $_SESSION['user_data']['ID']
			));
			$result = Db::result()['count'];

			return $result;
		}
		function createTourname($form_data){
			$tourname=$form_data['tournament_name'];
			Db::query("SELECT COUNT(*) AS count FROM tournaments WHERE tournament_name=:tournament_name");
			Db::executeOne(array(
				':tournament_name' => $tourname
			));
			$is_name_exist = Db::result()['count'];

			if($is_name_exist > 0){
				
				$result = array(
					'status' => false,
					'message' => 'Tournament name is already exist.',
				);				
			}
			else{
				$insert_array = array(
					'subscriber_id'		=> $_SESSION['user_data']['ID'],
					'tournament_name'	=> $tourname,
					'table_size'	=> $form_data['table_size'],
					'game_type'	=> $form_data['game_type'],
					'tournament_type'	=> $form_data['tournament_type'],
					'date_of_tourney'	=> date('Y-m-d'),
					'status'			=> 'active'
				);

				Db::insertQuery('tournaments',$insert_array);

				$result = array(
					'status' => true,
					'message' => 'Tournament name created.',
					'data' => array(
						'tournament_id' => Db::lastId()
					)
				);
			}

			return $result;
		}

		function getTournamentResult($tournament_id){

			Db::query('SELECT t.tournament_id,t.tournament_name, DATE_FORMAT(t.date_of_tourney,"%m/%d/%Y") AS date_of_tourney,t.status,t.winner,t.t_status,t.table_size,t.game_type,t.tournament_type,pd.player_name FROM tournaments t LEFT JOIN player_database pd ON t.winner=pd.player_id WHERE t.tournament_id=:tournament_id ORDER BY tournament_id DESC');
			Db::executeOne(array(
				':tournament_id'=>$tournament_id
			));
			$result = Db::result();

			$result['winner_id'] = $result['winner'];

			if($result['t_status'] == 1)
			{
				Db::query('SELECT s.winner,p.player_name FROM split_tables as s LEFT JOIN player_database as p ON s.winner = p.player_id WHERE tournament_id=:tournament_id ORDER BY split_id DESC');
				Db::executeOne(array(
					':tournament_id'=>$tournament_id
				));
				$resultnew = Db::result();
				// print_r($resultnew);
				// $result['winner'] = array_values($result['winner']);
				foreach($resultnew as $key => $value)
				{
					$result['winner'] .= $value['winner'];
					$result['player_name'] .= $value['player_name'];

					// Check if it's not the last element to add a comma
					if ($key !== count($resultnew) - 1) {
						$result['winner'] .= ', '; // Add comma and space for separation
						$result['player_name'] .= ', ';
					}
				}
			}else {
				$result['winner'] = $result['winner_id'];
			}

			Db::query('SELECT COUNT(*) AS count FROM tournament_players WHERE tournament_id=:tournament_id');
			Db::executeOne(array(
				':tournament_id' => $result['tournament_id']
			));
			$result['player_count'] = Db::result()['count']; 

			Db::query('SELECT table_id FROM tournament_tables WHERE tournament_id=:tournament_id');
			Db::execute(array(
				':tournament_id' => $tournament_id
			));
			$table_ids = Db::result();

			$tournament_players = array();

			foreach($table_ids as $key => $value){

				Db::query('SELECT t.player_one, t.player_two, t.winner, p1.player_name AS p1_player_name, p1.fargo_number AS p1_fargo_number, p2.player_name AS p2_player_name, p2.fargo_number AS p2_fargo_number FROM tournament_tables_players t LEFT JOIN player_database p1 ON t.player_one=p1.player_id LEFT JOIN player_database p2 ON t.player_two=p2.player_id WHERE t.table_id=:table_id AND t.winner IS NOT NULL');
				Db::execute(array(
					':table_id' => $value['table_id']
				));
				$this_players = Db::result();

				$tournament_players = array_merge($tournament_players,$this_players);
			}
			$result['tournament_players'] = $tournament_players;

			return $result;
		}
		function getTournamentSetupData($tournament_id){

			Db::query('SELECT t.tournament_id, t.tournament_name, DATE_FORMAT(t.date_of_tourney,"%m/%d/%Y") AS date_of_tourney , t.status, t.winner, pd.player_name FROM tournaments t LEFT JOIN player_database pd ON t.winner=pd.player_id WHERE t.tournament_id=:tournament_id ORDER BY tournament_id DESC');
			Db::executeOne(array(
				':tournament_id'=>$tournament_id
			));
			$result = Db::result();

			Db::query('SELECT tp.player_id, pd.player_name, pd.player_chips FROM tournament_players tp LEFT JOIN player_database pd ON tp.player_id=pd.player_id WHERE tp.tournament_id=:tournament_id');
			Db::execute(array(
				':tournament_id' => $result['tournament_id']
			));
			$result['players'] = Db::result(); 

			Db::query('SELECT * FROM tournament_tables WHERE tournament_id=:tournament_id');
			Db::execute(array(
				':tournament_id' => $tournament_id
			));
			$result['t_tables'] = Db::result();

			return $result;

		}

		function updateTournamentName($data){

			Db::query("SELECT COUNT(*) AS count FROM tournaments WHERE tournament_name=:tournament_name AND tournament_id!=:tournament_id");
			Db::executeOne(array(
				':tournament_name' => $data['new_tournament_name'],
				':tournament_id' => $data['tourney_id']
			));
			$is_name_exist = Db::result()['count'];

			if($is_name_exist > 0){

				$response = array(
					'status'  => false,
					'message' => "Name already exist."
				);
			}
			else{
				
				$update_array = array(
					'tournament_name' => $data['new_tournament_name']
				);

				$where = 'tournament_id='.$data['tourney_id'];

				Db::updateQuery('tournaments',$update_array,$where);

				$response = array(
					'status'  => true,
					'message' => "Name updated successfully"
				);
			}

			return $response;
		}
		function addUpdatePlayerToTourney($data){

			$player_id 		= $data['add_player_to_tourney'];
			$tourney_id 	= $data['tourney_id'];

			$data_array = array(
				'player_id' => $player_id,
				'tournament_id' => $tourney_id,
				'player_decrement_chip' => 1,
				'player_starting_chip' => $data['chip_amount'],
				'player_status' => 'active'
			);

			$data_array2 = array(
				'player_id'    => $player_id,
				'player_chips' => $data['chip_amount']
			);

			$where = 'player_id='.$player_id;
			
			Db::updateQuery('player_database',$data_array2,$where);

			Db::insertQuery('tournament_players',$data_array);

			$response = array(
				'status'  => true,
				'message' => 'Player Added.'
			);

			return $response;
		}

		function addTable($data){
// -------------------vishnu sort table------------------
			// $tournament_id = $data['tourney_id'];
			// Db::query('SELECT sort_position FROM tournament_tables WHERE tournament_id=:tournament_id ORDER BY table_id ASC LIMIT 0,1');
			// // Db::query('SELECT MIN(sort_position) as sort_position FROM tournamnet_tables WHERE tournament_id=:tournament_id');
			// Db::executeOne(array(
			// ':tournament_id' => $tournament_id
			// ));

			// $max_sort_postion = Db::result()['sort_position'];
			// // $response['aaa'] =$max_sort_postion;
			// if($max_sort_postion != NULL){
			// 	$sort_position = $max_sort_postion++;
			// }
			// else{
			// 	$sort_position = 1;
			// }
			// -------------vishn--------------


			//sort_position adding

			$tournament_id = $data['tourney_id'];

			// Fetch the maximum sort_position for the tournament_id from the database
			Db::query('SELECT MAX(sort_position) as max_sort_position FROM tournament_tables WHERE tournament_id=:tournament_id');
			$result = Db::executeOne(array(
				':tournament_id' => $tournament_id
			));
			
			$max_sort_position = $result['max_sort_position'];
			
			if ($max_sort_position !== NULL) {
				$sort_position = $max_sort_position + 1;
			} else {
				// If no sort_position found, set it to 1
				$sort_position = 1;
			}
			
			// Insert the new sort_position for the tournament_id
			// Db::query('INSERT INTO tournament_tables (tournament_id, sort_position) VALUES (:tournament_id, :sort_position)', array(
			// 	':tournament_id' => $tournament_id,
			// 	':sort_position' => $sort_position
			// ));
			
			// Now, $sort_position holds the updated value			

			$insert_array = array(
				'tournament_id' => $data['tourney_id'],
				'table_name'    => $data['add_new_table'],
				'sort_position' => $sort_position//vishnu sort table
			);

			Db::insertQuery('tournament_tables',$insert_array);

			$response = array(
				'status' => true,
				'message' => "Table Added"
			);

			return $response;
		}

		function addTableLive($data){

			//sortposition value adding

			$tournament_id = $data['tourney_id'];

			// Fetch the maximum sort_position for the tournament_id from the database
			Db::query('SELECT MAX(sort_position) as max_sort_position FROM tournament_tables WHERE tournament_id=:tournament_id');
			$result = Db::executeOne(array(
				':tournament_id' => $tournament_id
			));

			$max_sort_position = $result['max_sort_position'];

			if ($max_sort_position !== NULL) {
				$sort_position = $max_sort_position + 1;
			} else {
				// If no sort_position found, set it to 1
				$sort_position = 1;
			}

			// Insert the new sort_position for the tournament_id
			// Db::query('INSERT INTO tournament_tables (tournament_id, sort_position) VALUES (:tournament_id, :sort_position)', array(
			// 	':tournament_id' => $tournament_id,
			// 	':sort_position' => $sort_position
			// ));

			// Now, $sort_position holds the updated value

			$insert_array = array(
				'tournament_id' => $data['tourney_id'],
				'table_name'    => $data['add_new_table_live'],
				'sort_position' => $sort_position
			);

			Db::insertQuery('tournament_tables',$insert_array);
			$table_id = Db::lastId();

			Db::query('SELECT player_id FROM up_next_players WHERE tournament_id=:tournament_id ORDER BY sort_order ASC LIMIT 2');
			Db::execute(array(
				':tournament_id' => $data['tourney_id']
			));
			$result = Db::result();

			if(count($result) > 1){
				// date_default_timezone_set('Asia/Kolkata');
				date_default_timezone_set('UTC');
				// date_default_timezone_set('America/Los_Angeles');
				$current_time = date('Y-m-d H:i:s');

				$insert_array = array(
					'table_id' => $table_id,
					'player_one' => $result[0]['player_id'],
					'player_two' => $result[1]['player_id'],
					'start_time' => $current_time
				);
				
				Db::insertQuery('tournament_tables_players',$insert_array);

				foreach ($result as $key => $value) {

					$where = "tournament_id=".$data['tourney_id'].' AND player_id='.$value['player_id'];

					Db::deleteQuery('up_next_players',$where);
				}
			}

			$response = array(
				'status' => true,
				'message' => "Table Added"
			);

			return $response;
		}

		function updateTable($data){

			$update_array = array(
				'table_name'    => $data['update_table']
			);

			$where = "table_id=".$data['table_id'];

			Db::updateQuery('tournament_tables',$update_array,$where);

			$response = array(
				'status' => true,
				'message' => "Table Updated"
			);

			return $response;
		}

		function deleteTable($data){

			$where = "table_id=".$data['delete_table'];

			Db::deleteQuery('tournament_tables',$where);

			$response = array(
				'status' => true,
				'message' => "Table Deleted"
			);

			return $response;
		}
			function startTourney($tournament_id){

			Db::query('SELECT is_tourney_started FROM tournaments WHERE tournament_id=:tournament_id');
			Db::executeOne(array(
				':tournament_id' => $tournament_id
			));
			$is_tourney_started = Db::result()['is_tourney_started'];

			if($is_tourney_started == 1){
				return true;
			}

			Db::query('SELECT player_id FROM tournament_players WHERE tournament_id=:tournament_id');
			Db::execute(array(
				':tournament_id'=>$tournament_id
			));
			$tournament_players = Db::result();
			
			$players_list = array();

			foreach ($tournament_players as $key => $value) {
				array_push($players_list,$value['player_id']);
			}

			Db::query('SELECT * FROM tournament_tables WHERE tournament_id=:tournament_id');
			Db::execute(array(
				'tournament_id'=>$tournament_id
			));
			$tournament_tables = Db::result();

			$assigned_players = array();

			foreach($tournament_tables as $key => $value){

				if(array_rand($players_list,2)){
					$random_key = array_rand($players_list,2);
				// 	date_default_timezone_set('Asia/Kolkata');
					date_default_timezone_set('UTC');
					$current_time = date('Y-m-d H:i:s');
					$insert_array = array(
						'table_id' => $value['table_id'],
						'player_one' => $players_list[$random_key[0]],
						'player_two' => $players_list[$random_key[1]],
						'start_time' => $current_time
					);

					array_push($assigned_players, $players_list[$random_key[0]]);
					array_push($assigned_players, $players_list[$random_key[1]]);

					Db::insertQuery('tournament_tables_players',$insert_array);

					unset($players_list[$random_key[0]]);
					unset($players_list[$random_key[1]]);
				}
			}

			$i = 1;
			shuffle($players_list);
			foreach($players_list as $key => $value){
				
				if(!in_array($value,$assigned_players)){
					$insert_array = array(
						'tournament_id' => $tournament_id,
						'player_id'     => $value,
						'sort_order'    => $i 
 					);
					
 					$i++;
 					Db::insertQuery('up_next_players',$insert_array);
				}
			}

			$update_array = array(
				'is_tourney_started' => 1
			);	

			$where = 'tournament_id='.$tournament_id;

			Db::updateQuery('tournaments',$update_array,$where);
		}

		function getTournamentRunningData($tournament_id){

			$result = array();

			Db::query('SELECT tp.player_id, pd.player_name, pd.player_chips, tp.player_status FROM tournament_players tp LEFT JOIN player_database pd ON tp.player_id=pd.player_id WHERE tp.tournament_id=:tournament_id AND tp.player_status=:player_status ORDER BY player_chips DESC');
			Db::execute(array(
				':tournament_id' => $tournament_id,
				':player_status' => 'active'
			));
			$result['winner_is'] = Db::result(); 

			if(count($result['winner_is']) == 1){

				$result['tournament_status'] = 'over';

				$update_array = array(
					'status' => 'over',
					'winner' => $result['winner_is'][0]['player_id']
				);

				$where = 'tournament_id='.$tournament_id;

				Db::updateQuery('tournaments',$update_array,$where);
			}

			Db::query('SELECT t.tournament_id, t.tournament_name, DATE_FORMAT(t.date_of_tourney,"%m/%d/%Y") AS date_of_tourney , t.status, t.winner, pd.player_name FROM tournaments t LEFT JOIN player_database pd ON t.winner=pd.player_id WHERE t.tournament_id=:tournament_id ORDER BY tournament_id DESC');
			Db::executeOne(array(
				':tournament_id'=>$tournament_id
			));
			$result = Db::result();

			Db::query('SELECT tp.player_id, pd.player_name, pd.player_chips, tp.player_status FROM tournament_players tp LEFT JOIN player_database pd ON tp.player_id=pd.player_id WHERE tp.tournament_id=:tournament_id ORDER BY player_chips DESC');
			Db::execute(array(
				':tournament_id' => $result['tournament_id'],
			));
			$result['players'] = Db::result();

			Db::query('SELECT COUNT(*) AS count FROM tournament_players WHERE tournament_id=:tournament_id AND player_status!=:player_status');
			Db::executeOne(array(
				':tournament_id' => $result['tournament_id'],
				':player_status' => 'outfromgame',
			));
			$result['players_list_count'] = Db::result()['count']; 

			Db::query('SELECT * FROM tournament_tables WHERE tournament_id=:tournament_id AND status=:status ORDER BY sort_position');
			Db::execute(array(
				':tournament_id' => $tournament_id,
				':status'        => 'active'
			));
			$result['t_tables'] = Db::result();
			$alltablecount_ids=Db::result();


			Db::query('SELECT * FROM tournament_tables WHERE tournament_id=:tournament_id');
			Db::execute(array(
				':tournament_id' => $tournament_id
			));
			$t_tables_finished = Db::result();
			$in_countarray = array();
			foreach($result['t_tables'] as $key => $value){

				array_push($in_countarray,$value['table_id']);

			}
			$in_array_string_count = implode('","',$in_countarray);
			foreach($result['t_tables'] as $key => $value){

				Db::query('SELECT ttp.*,p.player_id As playeridone,p2.player_id As playeridtwo, p.player_name AS player_name_one, p.player_chips AS player_chip_one, p2.player_name AS player_name_two, p2.player_chips AS player_chip_two FROM tournament_tables_players ttp LEFT JOIN player_database p ON ttp.player_one=p.player_id LEFT JOIN player_database p2 ON ttp.player_two=p2.player_id WHERE table_id=:table_id AND winner IS NULL');
				Db::executeOne(array(
					':table_id'=>$value['table_id']
				));
				$this_data = Db::result();
				if($this_data){

					$result['t_tables'][$key]['players'] = Db::result();

					$player_idone = $this_data['playeridone'];

					

					

					Db::query('SELECT COUNT(winner) AS wincount FROM tournament_tables_players WHERE table_id IN ("'.$in_array_string_count.'") AND winner=:winner ');
				    // Db::query('SELECT count(ttp.winner) AS wincount FROM tournament_tables_players ttp LEFT JOIN player_database p ON ttp.winner=p.player_id  WHERE table_id=:table_id AND winner=:winner');
					// Db::query('SELECT count(ttp.winner) AS wincount FROM tournament_tables_players ttp WHERE table_id=:table_id AND winner=:winner');
					// Db::query('SELECT count(ttp.winner) AS wincount FROM tournament_tables_players ttp LEFT JOIN tournament_tables tt ON ttp.table_id=tt.table_id WHERE tt.tournament_id=:tournament_id AND winner=:winner');
					// Db::query('SELECT count(winner) AS wincount FROM tournament_tables_players WHERE winner=:winner');

				
					Db::executeOne(array(
						// ':table_id'=>$value['table_id'] ,
						//  ':tournament_id'=>$tournament_id ,
						':winner'=>$player_idone
					));
					// $wincount =Db::result()['wincount'];
					$result['t_tables'][$key]['players']['wincount'] =Db::result()['wincount'];
					// Db::query('SELECT count(ttp.loser) AS losecount FROM tournament_tables_players ttp WHERE table_id=:table_id AND loser=:loser');
					// Db::query('SELECT count(ttp.loser) AS losecount FROM tournament_tables_players ttp WHERE loser=:loser');
					Db::query('SELECT COUNT(loser) AS losecount FROM tournament_tables_players WHERE table_id IN ("'.$in_array_string_count.'") AND loser=:loser ');

				
					Db::executeOne(array(
						// ':table_id'=>$value['table_id'] ,
						':loser'=>$player_idone
					));
					$result['t_tables'][$key]['players']['losecount'] =Db::result()['losecount'];

					$player_idtwo = $this_data['playeridtwo'];


				    // Db::query('SELECT count(ttp.winner) AS wincount FROM tournament_tables_players ttp LEFT JOIN player_database p ON ttp.winner=p.player_id  WHERE table_id=:table_id AND winner=:winner');
					// Db::query('SELECT count(ttp.winner) AS wincount FROM tournament_tables_players ttp WHERE table_id=:table_id AND winner=:winner');
					Db::query('SELECT COUNT(winner) AS wincount FROM tournament_tables_players WHERE table_id IN ("'.$in_array_string_count.'") AND winner=:winner ');

				
					Db::executeOne(array(
						// ':table_id'=>$value['table_id'] ,
						':winner'=>$player_idtwo
					));
					// $wincount =Db::result()['wincount'];
					$result['t_tables'][$key]['players']['wincounttwo'] =Db::result()['wincount'];
					// Db::query('SELECT count(ttp.loser) AS losecount FROM tournament_tables_players ttp WHERE table_id=:table_id AND loser=:loser');
					Db::query('SELECT COUNT(loser) AS losecount FROM tournament_tables_players WHERE table_id IN ("'.$in_array_string_count.'") AND loser=:loser ');

				
					Db::executeOne(array(
						// ':table_id'=>$value['table_id'] ,
						':loser'=>$player_idtwo
					));
					$result['t_tables'][$key]['players']['losecounttwo'] =Db::result()['losecount'];





				}
				else{

					unset($result['t_tables'][$key]);
				}
				
			}
			//wincount
			// foreach($result['t_tables'] as $key => $value){

			// 	Db::query('SELECT count(ttp.winner) AS wincount FROM tournament_tables_players ttp LEFT JOIN player_database p ON ttp.winner=p.player_id  WHERE table_id=:table_id');
			// 	// Db::query('SELECT count(ttp.winner) AS wincount FROM tournament_tables_players ttp LEFT JOIN player_database p ON ttp.winner=p.player_id  WHERE table_id=:table_id AND winner=:winner');

				
			// 	Db::executeOne(array(
			// 		':table_id'=>$value['table_id']
			// 		// ,
			// 		// ':winner'=>$result['players'][0]['player_id']
			// 	));
			// 	$this_data = Db::result()['wincount'];
			// 	if($this_data){

			// 		$result['t_tables'][$key]['players']['wincount'] =  Db::result()['wincount'];
			// 	}
				
				
			// }

			//lose count


			// foreach($result['t_tables'] as $key => $value){

			// 	Db::query('SELECT count(ttp.loser) AS losecount FROM tournament_tables_players ttp LEFT JOIN player_database p ON ttp.loser=p.player_id  WHERE table_id=:table_id');
			// 	// Db::query('SELECT count(ttp.winner) AS wincount FROM tournament_tables_players ttp LEFT JOIN player_database p ON ttp.winner=p.player_id  WHERE table_id=:table_id AND winner=:winner');

				
			// 	Db::executeOne(array(
			// 		':table_id'=>$value['table_id']
			// 		// ,
			// 		// ':winner'=>$result['players'][0]['player_id']
			// 	));
			// 	$this_data = Db::result()['losecount'];
			// 	if($this_data){

			// 		$result['t_tables'][$key]['players']['losecount'] =  Db::result()['losecount'];
			// 	}
				
				
			// }
			

			$in_array = array();

			foreach($t_tables_finished as $key => $value){

				array_push($in_array,$value['table_id']);

			}

			$in_array_string = implode('","',$in_array);

			Db::query('SELECT COUNT(*) AS count FROM tournament_tables_players WHERE table_id IN ("'.$in_array_string.'") AND winner IS NULL');
			Db::executeOne();
			$this_result = Db::result()['count'];

			if($this_result > 0){

				$result['reshuffle'] = 'false';
			}
			else{

				$result['reshuffle'] = 'true';	
			}

			Db::query('SELECT COUNT(*) AS count FROM tournament_tables_players WHERE table_id IN ("'.$in_array_string.'") AND winner IS NOT NULL');
			Db::executeOne();
			$this_result = Db::result()['count'];

			if($this_result > 0){
				// $player_id='';
				foreach($t_tables_finished as $key => $value){

					Db::query('SELECT ttp.*,p.player_name AS player_name_one, p.player_chips AS player_chip_one, p2.player_name AS player_name_two, p2.player_chips AS player_chip_two FROM tournament_tables_players ttp LEFT JOIN player_database p ON ttp.player_one=p.player_id LEFT JOIN player_database p2 ON ttp.player_two=p2.player_id WHERE table_id=:table_id AND winner IS NOT NULL');
					Db::execute(array(
						':table_id'=>$value['table_id']
					));
					$t_tables_finished[$key]['players'] = Db::result();
					
				}

				$result['t_tables_finished'] = $t_tables_finished;
			}

			Db::query('SELECT tp.player_id, pd.player_name, pd.player_chips, tp.player_status FROM tournament_players tp LEFT JOIN player_database pd ON tp.player_id=pd.player_id WHERE tp.tournament_id=:tournament_id AND tp.player_status=:player_status ORDER BY player_chips DESC');
			Db::execute(array(
				':tournament_id' => $result['tournament_id'],
				':player_status' => 'active'
			));
			$result['winner_is'] = Db::result(); 

			if(count($result['winner_is']) == 1){

				$result['tournament_status'] = 'over';

				$update_array = array(
					'status' => 'over',
					'winner' => $result['players'][0]['player_id']
				);

				$where = 'tournament_id='.$tournament_id;

				Db::updateQuery('tournaments',$update_array,$where);
			}
			else{
				$result['tournament_status'] = "active";
			}

			Db::query('SELECT player_one,player_two FROM tournament_tables_players WHERE table_id IN ("'.$in_array_string.'") AND winner IS NULL');
			Db::execute();
			$currently_playing = Db::result();

			$currently_playing_array = array();

			foreach($currently_playing as $key => $value){

				array_push($currently_playing_array,$value['player_one']);
				array_push($currently_playing_array,$value['player_two']);
			}

			$result['currently_playing_array'] = $currently_playing_array;

			
			 Db::query('SELECT up.player_id, pd.player_name, pd.player_chips, up.sort_order, up.up_next_id FROM up_next_players up LEFT JOIN player_database pd ON up.player_id=pd.player_id WHERE up.tournament_id=:tournament_id ORDER BY sort_order');
			// Db::query('SELECT count(ttp.winner) as wincount,up.player_id, pd.player_name, pd.player_chips, up.sort_order, up.up_next_id FROM up_next_players up LEFT JOIN player_database pd ON up.player_id=pd.player_id LEFT JOIN tournament_tables tt ON tt.tournament_id=up.tournament_id LEFT JOIN tournament_tables_players ttp ON ttp.table_id=tt.table_id  WHERE up.tournament_id=:tournament_id ORDER BY sort_order');

			Db::execute(array(
				':tournament_id' => $tournament_id
			));
			
			$result['up_next_list'] = Db::result();
			// $player_id = $result[0]['player_id'];
			foreach($result['up_next_list'] as $key => $value){
				Db::query('SELECT count(ttp.winner) AS wincount FROM tournament_tables_players ttp LEFT JOIN tournament_tables tt ON ttp.table_id=tt.table_id WHERE tt.tournament_id=:tournament_id AND winner=:winner');

				
					Db::executeOne(array(
						// ':table_id'=>$value['table_id'] ,
						 ':tournament_id'=>$tournament_id ,
						':winner'=>$value['player_id']
					));
					$result['up_next_list'][$key]['counts'] = Db::result();

			}
			foreach($result['up_next_list'] as $key => $value){
				Db::query('SELECT count(ttp.loser) AS losecount FROM tournament_tables_players ttp LEFT JOIN tournament_tables tt ON ttp.table_id=tt.table_id WHERE tt.tournament_id=:tournament_id AND loser=:loser');

				
					Db::executeOne(array(
						// ':table_id'=>$value['table_id'] ,
						 ':tournament_id'=>$tournament_id ,
						':loser'=>$value['player_id']
					));
					$result['up_next_list'][$key]['countsloser'] = Db::result();

			}

			return $result;
		}

		function deleteTableRunning($data){

			if(isset($_SESSION['table_delete_id'])){

				array_push($_SESSION['table_delete_id'],$data['delete_table_running']);
			}
			else{

				$_SESSION['table_delete_id'] = array();
				array_push($_SESSION['table_delete_id'],$data['delete_table_running']);
			}

			$response = array(
				'status' => true,
				'message' => "Table Deleted"
			);

			return $response;
		}

		function updateWinner($data){
			//Setting undo stack
			if(!isset($_SESSION['undo']['operationstack'][$data['tourney_id']])){
				$_SESSION['undo']['operationstack'][$data['tourney_id']] = array();
			}
			
			$operationstack = array();
			$operationstack['operation'] = "updateWinner";
			//Setting undo stackdate("Y-m-d H:i:s")
			// $current_time = date('H:i:s');
			// $current_time = date('Y-m-d H:i:s');
// 			date_default_timezone_set('Asia/Kolkata');
            date_default_timezone_set('UTC');
			$current_time = date('Y-m-d H:i:s');
			

			$update_array = array(
				'winner' => $data['update_winner'],
				'loser' => $data['loser'],
				'end_time' => $current_time
			); 

			$where = 'assign_table_id='.$data['assign_table_id'];
			Db::updateQuery('tournament_tables_players',$update_array,$where);

			$operationstack['assign_table_id'] 	= $data['assign_table_id'];
			$operationstack['tourney_id']   	= $data['tourney_id'];

			Db::query('SELECT player_decrement_chip FROM  tournament_players WHERE player_id=:player_id AND tournament_id=:tournament_id');
			Db::executeOne(array(
				':player_id' => $data['loser'],
				':tournament_id' => $data['tourney_id']
			));
			$decre_chip = Db::result()['player_decrement_chip'];

			Db::query('SELECT player_chips FROM player_database WHERE player_id=:player_id');
			Db::executeOne(array(
				':player_id' => $data['loser']
			));
			$current_chip = Db::result()['player_chips'];
			
			$final_chips  =  $current_chip-$decre_chip;
			
			$update_array = array(
				'player_chips' => $final_chips
			);

			$where = 'player_id='.$data['loser'];

			Db::updateQuery('player_database',$update_array,$where);

			if($final_chips <= 0){

				$update_array = array(
					'player_status' => 'not active'
				);

				$where = 'player_id='.$data['loser']." AND tournament_id=".$data['tourney_id'];

				Db::updateQuery('tournament_players',$update_array,$where);
			}
			$table_delete_status = false;
			//check upnext_players table contain tournament_id
			
			if(isset($_SESSION['table_delete_id'])){

				$delete_ids = $_SESSION['table_delete_id'];

				Db::query('SELECT table_id FROM tournament_tables_players WHERE assign_table_id=:assign_table_id');
				Db::executeOne(array(
					':assign_table_id' => $data['assign_table_id']
				));
				$delete_table_result = Db::result();

				if(isset($delete_table_result['table_id'])){

					if(in_array($delete_table_result['table_id'],$delete_ids)){

						$update_array = array(
							'status' => 'not active'
						);

						$where = 'table_id='.$delete_table_result['table_id'];

						Db::updateQuery('tournament_tables',$update_array,$where);
						
						$table_delete_status = true;
						
						foreach($_SESSION['table_delete_id'] as $key => $value){

							if($value == $delete_table_result['table_id']){
								unset($_SESSION['table_delete_id'][$key]);
							}
						}
					}
				}
			}

			$operationstack['table_delete_status'] = $table_delete_status;

			if((!isset($_SESSION['reshuffle_enabled']) || $_SESSION['reshuffle_enabled'] != $data['tourney_id']) && $table_delete_status == false){

				$assign = true;

				if($final_chips > 0){

					Db::query('SELECT MAX(sort_order) as max_sort FROM up_next_players WHERE tournament_id=:tournament_id');
					Db::executeOne(array(
						':tournament_id' => $data['tourney_id']
					));
		            $max_sort = Db::result()['max_sort'];

					$insert_array = array(
						'tournament_id' => $data['tourney_id'],
						'player_id'     => $data['loser'],
						'sort_order'    => $max_sort+1
					);

					Db::insertQuery('up_next_players',$insert_array);
				}
				else{

					Db::query('SELECT COUNT(*) AS count FROM up_next_players WHERE tournament_id=:tournament_id');
					Db::executeOne(array(
						':tournament_id' => $data['tourney_id']
					));
					$current_players_in_next = Db::result()['count'];

					if($current_players_in_next == 0){
						$assign = false;
						$insert_array = array(
							'tournament_id' => $data['tourney_id'],
							'player_id'     => $data['update_winner'],
							'sort_order'    => 1
						);

						Db::insertQuery('up_next_players',$insert_array);

						$operationstack['remove_both_upnext'] = 'yes';
					}
				}

				if($assign == true){

					Db::query('SELECT player_id FROM up_next_players WHERE tournament_id=:tournament_id ORDER BY sort_order LIMIT 1');
					Db::executeOne(array(
						':tournament_id' => $data['tourney_id']
					));
		            $new_player_id = Db::result()['player_id'];

		            $where = 'tournament_id='.$data['tourney_id'].' AND player_id='.$new_player_id;

		            Db::deleteQuery('up_next_players',$where);

					Db::query('SELECT table_id FROM tournament_tables_players WHERE assign_table_id=:assign_table_id');
					Db::executeOne(array(
						':assign_table_id' => $data['assign_table_id']
					));
					$table_id = Db::result()['table_id'];
					// $current_time = date('H:i:s');
					// $current_time = date('Y-m-d H:i:s');
				// 	date_default_timezone_set('Asia/Kolkata');
					date_default_timezone_set('UTC');

					$current_time = date('Y-m-d H:i:s');
					

					$insert_array = array(
						'table_id' => $table_id,
						'player_one' => $data['update_winner'],
						'player_two' => $new_player_id,
						'start_time' => $current_time 
					);

					Db::insertQuery('tournament_tables_players',$insert_array);

					$operationstack['new_assign_table_id'] = Db::lastId();
					$operationstack['remove_both_upnext'] = 'no';
				}
			}
			elseif((isset($_SESSION['reshuffle_enabled']) && $_SESSION['reshuffle_enabled'] == $data['tourney_id']) || $table_delete_status == true){

				Db::query('SELECT sort_order,up_next_id FROM up_next_players WHERE tournament_id=:tournament_id');
				Db::execute(array(
					':tournament_id' => $data['tourney_id']
				));
	            $sort_orders = Db::result();

	            foreach($sort_orders as $key => $value){

	            	$update_array = array(
	            		'sort_order' => $value['sort_order']+1
	            	);

	            	$where = 'up_next_id='.$value['up_next_id'];

	            	Db::updateQuery('up_next_players',$update_array,$where);
	            }

	            Db::query('SELECT MIN(sort_order) as min_sort,MAX(sort_order) as max_sort FROM up_next_players WHERE tournament_id=:tournament_id');
				Db::executeOne(array(
					':tournament_id' => $data['tourney_id']
				));
	            $sort = Db::result();

				$insert_array = array(
					'tournament_id' => $data['tourney_id'],
					'player_id'     => $data['update_winner'],
					'sort_order'    => $sort['min_sort']-1
				);

				Db::insertQuery('up_next_players',$insert_array);

				if($final_chips > 0){
					$insert_array = array(
						'tournament_id' => $data['tourney_id'],
						'player_id'     => $data['loser'],
						'sort_order'    => $sort['max_sort']+1
					);

					Db::insertQuery('up_next_players',$insert_array);
				}

				$operationstack['remove_both_upnext'] = 'yes';
			}

			array_push($_SESSION['undo']['operationstack'][$data['tourney_id']],$operationstack);

			$response = array(
				'status' => true,
				'message' => "Winner Updated"
			);

			return $response;
		}

		function reshuffleTourney($tournament_id){

			Db::query('SELECT player_id FROM tournament_players WHERE tournament_id=:tournament_id AND player_status=:player_status');
			Db::execute(array(
				':tournament_id'=>$tournament_id,
				':player_status'=>'active'
			));
			$tournament_players = Db::result();
			
			$players_list = array();

			foreach ($tournament_players as $key => $value) {

				Db::query('SELECT player_chips FROM player_database WHERE player_id=:player_id');
				Db::executeOne(array(
					':player_id' => $value['player_id']
				));
				$player_chip = Db::result()['player_chips'];

				if($player_chip > 0){
					array_push($players_list,$value['player_id']);
				}
			}

			Db::query('SELECT * FROM tournament_tables WHERE tournament_id=:tournament_id AND status=:status');
			Db::execute(array(
				'tournament_id'=>$tournament_id,
				'status' => 'active'
			));
			$tournament_tables = Db::result();

			$assigned_players = array();

			foreach($tournament_tables as $key => $value){

				if(array_rand($players_list,2)){
					$random_key = array_rand($players_list,2);
					
					$insert_array = array(
						'table_id' => $value['table_id'],
						'player_one' => $players_list[$random_key[0]],
						'player_two' => $players_list[$random_key[1]]
					);

					array_push($assigned_players, $players_list[$random_key[0]]);
					array_push($assigned_players, $players_list[$random_key[1]]);

					Db::insertQuery('tournament_tables_players',$insert_array);

					unset($players_list[$random_key[0]]);
					unset($players_list[$random_key[1]]);
				}
			}
			
			$where = 'tournament_id='.$tournament_id;

	        Db::deleteQuery('up_next_players',$where);

			$i = 1;

			foreach($players_list as $key => $value){
				
				if(!in_array($value,$assigned_players)){
					$insert_array = array(
						'tournament_id' => $tournament_id,
						'player_id'     => $value,
						'sort_order'    => $i 
 					);

 					$i++;

 					Db::insertQuery('up_next_players',$insert_array);
				}
			}

			$_SESSION['reshuffle_complete'] = $_SESSION['reshuffle_enabled'];
			unset($_SESSION['reshuffle_enabled']);
		}
// vishnupriya get playername
		function get_a_player_name($data){

			$tournament_id = $data['tourney_id'];
			$player_id     = $data['get_a_player_name'];

			Db::query('SELECT player_name FROM player_database WHERE player_id=:player_id');
			Db::executeOne(array(
				':player_id' => $player_id
			));
			$player_data = Db::result();

			Db::query('SELECT player_starting_chip FROM tournament_players WHERE player_id=:player_id AND tournament_id=:tournament_id');
			Db::executeOne(array(
				':player_id' => $player_id,
				':tournament_id' => $tournament_id
			));
			$player_data['player_starting_chip'] = Db::result()['player_starting_chip'];

			$result['player_get_name'] = $player_data;
			return $result;

		}
// vishnupriya get playername end
		function get_a_player_details($data){
			
			$tournament_id = $data['tourney_id'];
			$player_id     = $data['get_a_player_details'];

			Db::query('SELECT * FROM player_database WHERE player_id=:player_id');
			Db::executeOne(array(
				':player_id' => $player_id
			));
			$player_data = Db::result();

			Db::query('SELECT player_starting_chip FROM tournament_players WHERE player_id=:player_id AND tournament_id=:tournament_id');
			Db::executeOne(array(
				':player_id' => $player_id,
				':tournament_id' => $tournament_id
			));
			$player_data['player_starting_chip'] = Db::result()['player_starting_chip'];

			Db::query('SELECT * FROM tournament_tables WHERE tournament_id=:tournament_id');
			Db::execute(array(
				':tournament_id' => $tournament_id
			));
			$all_tables = Db::result();
			$all_table_ids  = array();

			foreach ($all_tables as $key => $value) {
				
				array_push($all_table_ids,$value['table_id']);
			}

			$all_table_id_string = implode('","',$all_table_ids);

			Db::query('SELECT * FROM tournament_tables_players WHERE table_id IN ("'.$all_table_id_string.'") AND winner IS NOT NULL AND (player_one=:player_one OR player_two=:player_two)');
			Db::execute(array(
				':player_one' => $player_id,
				':player_two' => $player_id
			));
			$games_played = Db::result();
			
			$games_played_list = array();
			$totalTimes = array(); // Initialize an array to store time differences for calculation VP
			$count_win = 0;
			$count_loss = 0;
			foreach ($games_played as $key => $value) {

				if($player_id == $value['player_one']){

					// echo "hi";
					$this_player_id = $value['player_two'];
				}
				else{

					$this_player_id = $value['player_one'];
				}
				
				
				if($player_id == $value['winner']){

					$win_or_loss = "Win";
					$count_win++;
					
					// echo $count_win;
				}
				if($player_id == $value["loser"]){

					$win_or_loss = "Loss";
					$count_loss++;
					// echo $count_loss;
				}
				// echo($count_win);
				$startDateTime = new DateTime($value['start_time']);
				$endDateTime = new DateTime($value['end_time']);
				$timeDifference = $startDateTime->diff($endDateTime);

				$timeDifferenceString = $timeDifference->format('%H:%I:%S');
				$totalTimes[] = $timeDifferenceString;//VP
			
				// Calculate the total time from the stored time differences
				$totalTime = new DateInterval('PT0S'); // Initialize the total time interval to 0 seconds

				foreach ($totalTimes as $timeString) {
					$parts = explode(':', $timeString);
					$totalTime->h += (int)$parts[0];
					$totalTime->i += (int)$parts[1];
					$totalTime->s += (int)$parts[2];
			
					// Handle any carryover from seconds and minutes
					$totalTime->i += floor($totalTime->s / 60);
					$totalTime->s %= 60;
					$totalTime->h += floor($totalTime->i / 60);
					$totalTime->i %= 60;
				}
					
				 // Format the total time difference as a string
				 $totalTimeFormatted = $totalTime->format('%H:%I:%S');

//----------------
				Db::query('SELECT player_name, fargo_number FROM player_database WHERE player_id=:player_id');
				Db::executeOne(array(
					':player_id' => $this_player_id
				));
				$this_player_data = Db::result();
				$this_player_data['win_or_loss'] = $win_or_loss;
				$this_player_data['count_win'] = $count_win;
				$this_player_data['count_loss'] = $count_loss;
				$this_player_data['match_time'] = $timeDifferenceString;
				

				array_push($games_played_list, $this_player_data);

			}
		
			$result['player_data'] = $player_data;
			$result['games_played_list'] = $games_played_list;
			$result['total_time'] = $totalTimeFormatted; // Add the total time to the result
			
			return $result;
		}

		function check_player_deletable($data){

			$tournament_id = $data['tourney_id'];
			$player_id     = $data['check_player_deletable'];

			Db::query('SELECT * FROM tournament_tables WHERE tournament_id=:tournament_id');
			Db::execute(array(
				':tournament_id' => $tournament_id
			));
			$all_tables = Db::result();
			$all_table_ids  = array();

			foreach ($all_tables as $key => $value) {
				
				array_push($all_table_ids,$value['table_id']);
			}

			$all_table_id_string = implode('","',$all_table_ids);

			Db::query('SELECT COUNT(*) AS count FROM tournament_tables_players WHERE table_id IN ("'.$all_table_id_string.'") AND winner IS  NULL AND (player_one=:player_one OR player_two=:player_two)');
			Db::executeOne(array(
				':player_one' => $player_id,
				':player_two' => $player_id
			));
			$is_playing = Db::result()['count'];

			if($is_playing > 0){

				$response = array(
					'status'  => false,
					'message' => "The player can't delete, player is playing now."
				);

				return $response;
			}
			else{

				$update_array = array(
					'player_status' => 'outfromgame'
				);	

				$where = "tournament_id=".$tournament_id." AND player_id=".$player_id;

				Db::updateQuery('tournament_players',$update_array,$where);
				Db::deleteQuery('up_next_players',$where);

				$response = array(
					'status'  => true,
				);

				return $response;
			}
		}

		function deleteTourney($tourney_id){

			Db::query('SELECT tp.player_id,pd.player_id AS db_player_id, pd.show_in_database  FROM tournament_players tp LEFT JOIN player_database pd ON tp.player_id = pd.player_id WHERE tournament_id=:tournament_id');
			Db::execute(array(
				':tournament_id' => $tourney_id
			));
			$player_ids = Db::result();

			Db::query('SELECT table_id FROM tournament_tables WHERE tournament_id=:tournament_id');
			Db::execute(array(
				':tournament_id' => $tourney_id
			));
			$table_ids = Db::result();
			
			foreach($table_ids as $key => $value){
				
				$where = 'table_id='.$value['table_id'];

				Db::DeleteQuery('tournament_tables_players',$where);	
			}

			$where_up_next = 'tournament_id='.$tourney_id;
			Db::DeleteQuery('up_next_players',$where_up_next);

			$where = 'tournament_id='.$tourney_id;
			Db::DeleteQuery('tournament_tables',$where);

			$where = 'tournament_id='.$tourney_id;
			Db::DeleteQuery('tournament_players',$where);

			foreach($player_ids as $key => $value){
				
				if($value['show_in_database'] == 'no'){
					
					$where = 'player_id='.$value['db_player_id'];
					Db::DeleteQuery('player_database',$where);	
				}
			}

			$where = 'tournament_id='.$tourney_id;
			Db::DeleteQuery('tournaments',$where);

			$response = array(
				'status'  => true,
			);

			return $response;
		}

		function deletePlayerPermanent($data){

			$tournament_id = $data['tourney_id'];
			$player_id     = $data['delete_player_permanently'];

			$where = "tournament_id=".$tournament_id." AND player_id=".$player_id;
			$where_second = "player_id=".$player_id." AND show_in_database='no'";

			Db::deleteQuery('tournament_players',$where);
			Db::deleteQuery('player_database',$where_second);

			$response = array(
				'status'  => true,
			);

			return $response;
		}

		function playersLeft($tournament_id){

			Db::query('SELECT COUNT(*) AS left_players_count FROM tournament_players WHERE tournament_id=:tournament_id AND player_status=:player_status');
			Db::executeOne(array(
				':tournament_id' => $tournament_id,
				':player_status' => 'active'
			));
			return Db::result()['left_players_count'];
		}

		function playersDeleted($tournament_id){

			Db::query('SELECT COUNT(*) AS players_deleted FROM tournament_players WHERE tournament_id=:tournament_id AND player_status=:player_status');
			Db::executeOne(array(
				':tournament_id' => $tournament_id,
				':player_status' => 'outfromgame'
			));
			return Db::result()['players_deleted'];
		}

		function updateUpNextTable($data){

			foreach($data as $key => $value){

				$update_array = array(
					'sort_order' => $key+1
				);

				$where = 'up_next_id='.$value;

				Db::updateQuery('up_next_players',$update_array,$where);
			}

			$response = array(
				'status'  => true,
			);

			return $response;
		}
	
		function addUpdatePlayerToRunningTourney($data){ //fromdb

			$player_id 		= $data['add_player_to_running_tourney'];
			$tourney_id 	= $data['tourney_id'];
			$chip_amount 	= $data['chip_amount'];

			$data_array = array(
				'player_id' => $player_id,
				'tournament_id' => $tourney_id,
				'player_decrement_chip' => 1,
				'player_starting_chip' => $chip_amount,
				'player_status' => 'active'
			);

			$data_array2 = array(
				'player_id'    => $player_id,
				'player_chips' => $chip_amount
			);

			$where = 'player_id='.$player_id;
			
			Db::updateQuery('player_database',$data_array2,$where);

			Db::query('SELECT COUNT(*) AS count FROM tournament_players WHERE tournament_id=:tournament_id AND player_id=:player_id');
			Db::executeOne(array(
				':tournament_id' => $tourney_id,
				':player_id' => $player_id
			));
			$is_exist = Db::result()['count'];

			if($is_exist > 0){

				$data_uparray = array(
					'player_status' => 'active'
				);

				$where = 'player_id='.$player_id.' AND tournament_id='.$tourney_id;
				Db::updateQuery('tournament_players',$data_uparray,$where);
			}
			else{

				Db::insertQuery('tournament_players',$data_array);	
			}
			

			Db::query('SELECT MIN(sort_order) as sort_order FROM up_next_players WHERE tournament_id=:tournament_id');
			Db::executeOne(array(
				':tournament_id' => $tourney_id
			));
			$max_sort_order = Db::result()['sort_order'];

			if($max_sort_order != NULL){
				$sort_order = $max_sort_order-1;
			}
			else{
				$sort_order = 1;
			}

			$insert_array = array(
				'tournament_id'	=> $tourney_id,
				'player_id'		=> $player_id,
				'sort_order'	=> $sort_order
			);
				
			Db::insertQuery('up_next_players',$insert_array);

			$message = 'Player added to up next list';

			$response = array(
				'status'  => true,
				'message' => $message
			);

			return $response;
		}
		//=======
		function swapPlayer($data){
			date_default_timezone_set('UTC');
			$current_time = date('Y-m-d H:i:s');
			//print_r($data['swapplayer']);
			//$data['swapplayer'] = (int)$data['swapplayer'];
			if($data['player_pos']	==	"player_one"){
				$update_array = array(
				'player_one' => $data['swapplayer'],
				'end_time' => $current_time
			); 

			}
			else {
					$update_array = array(
					'player_two' => $data['swapplayer'],
					'end_time' => $current_time
				); 

			}
			

			 $where = 'assign_table_id = '.$data['table_Assigned'] .' AND '. $data['player_pos'].' = '.$data['OldplayerFrom'];			
			Db::updateQuery('tournament_tables_players',$update_array,$where);

			$update_Array_players_Tournamnet	=	array(
					'player_id' => $data['swapplayer']	
				); 
				 $where_players_tournament = 'player_id = '.$data['OldplayerFrom'] .' AND  tournament_id = '. $data['tournamentId'];	
				// print_r($update_Array_players_Tournamnet);
			//exit;
			Db::updateQuery('tournament_players',$update_Array_players_Tournamnet,$where_players_tournament);
			Db::query('SELECT player_id FROM up_next_players WHERE tournament_id=:tournament_id  AND player_id=:player_id ORDER BY sort_order LIMIT 1');
					Db::executeOne(array(
						':tournament_id' => $data['tournamentId'],
						':player_id' => $data['swapplayer']
					));
		            $new_player_id = Db::result()['player_id'];					

		            $where = 'tournament_id='.$data['tournamentId'].' AND player_id='.$new_player_id;
					if(!empty($new_player_id)){
		            Db::deleteQuery('up_next_players',$where);
					}
					$response = array(
				'status' => true,
				'message' => "Swapped Successfully"
			);
			// $pp_id = $data['OldplayerFrom'];
			// DB::query('SELECT player_name FROM player_database WHERE player_id = :player_id');
			// Db::execute(array(
			// 	':player_id' => $pp_id,
			// ));
			// $response['player_name'] = Db::result();

			return $response;

		}
		//=========
		function getTournamentSwapList($tournament_id){
			echo "Here".$tournament_id;
		}
		//========================================================================
		function getTournamentSplitData($data){
		//function Split_winners($data){
		
		$result = array();
		//$tournament_id = $data["tournament_id"];
		$tournament_id = $data;
		//echo $tournament_id;exit;
		Db::query('SELECT table_id FROM tournament_tables WHERE tournament_id = :tournament_id');
		
		Db::execute(array(
			':tournament_id' => $tournament_id,
		));

		$table_IDs = Db::result();
	//	echo "<pre/>";print_r($table_IDs);exit;
	/*	foreach($table_IDs as $k => $table_ids_torney)
		{
			$tableID	=	$table_ids_torney['table_id'];
			echo "new".$tableID;
			//$tableID	=	1947;
			Db::query('SELECT ttp.winner, COUNT(winner) AS winc,tp.player_id, tp.player_decrement_chip,tp.player_starting_chip,(tp.player_starting_chip - tp.player_decrement_chip) AS chip_difference,pd.player_name, pd.player_chips, tp.player_status FROM tournament_tables_players AS ttp LEFT JOIN player_database pd ON ttp.winner=pd.player_id LEFT JOIN tournament_players tp ON tp.player_id=pd.player_id WHERE tp.tournament_id = :tournament_id AND tp.player_status = "active" AND ttp.`table_id` = :table_id Group BY `winner` order by winc desc,chip_difference asc,pd.player_chips DESC LIMIT 1');

			Db::execute(array(
				':table_id' => $tableID,
				':tournament_id' => $tournament_id,
			));
			$table_winners = Db::result();			
			echo "<pre/>";print_r($table_winners); */


		//================================================================
	
//=================================
$finalWinner = null;
$finalWinnerCriteria = array('winc' => -1, 'chip_difference' => -1, 'player_chips' => -1);

foreach ($table_IDs as $table_ids_torney) {
    $tableID = $table_ids_torney['table_id'];
    
	 Db::query('SELECT ttp.winner, COUNT(winner) AS winc,tp.player_id, tp.player_decrement_chip,tp.player_starting_chip,(tp.player_starting_chip - tp.player_decrement_chip) AS chip_difference,pd.player_name, pd.player_chips, tp.player_status FROM tournament_tables_players AS ttp LEFT JOIN player_database pd ON ttp.winner=pd.player_id LEFT JOIN tournament_players tp ON tp.player_id=pd.player_id WHERE tp.tournament_id = :tournament_id AND tp.player_status = "active" AND ttp.`table_id` = :table_id Group BY `winner` order by winc desc,chip_difference asc,pd.player_chips DESC');

    Db::execute(array(
        ':table_id' => $tableID,
        ':tournament_id' => $tournament_id,
    ));
    $table_winners = Db::result();
    echo $tableID."From query";
	echo "<pre/>";print_r($table_winners);
	echo "/n===================================================/n";
    // Your existing code to fetch table_winners goes here

    if (!empty($table_winners)) {
        $table_winner = $table_winners[0]; // Initialize with the first winner

        foreach ($table_winners as $winner) {
			
            if ($winner['winc'] > $table_winner['winc'] ||
                ($winner['winc'] == $table_winner['winc'] && $winner['chip_difference'] > $table_winner['chip_difference']) ||
                ($winner['winc'] == $table_winner['winc'] && $winner['chip_difference'] == $table_winner['chip_difference'] && $winner['player_chips'] > $table_winner['player_chips'])) {
                $table_winner = $winner;
            }
        }


        // Compare the winner's attributes to determine the final winner
        if ($table_winner['winc'] > $finalWinnerCriteria['winc'] ||
            ($table_winner['winc'] == $finalWinnerCriteria['winc'] &&
            $table_winner['chip_difference'] > $finalWinnerCriteria['chip_difference']) ||
            ($table_winner['winc'] == $finalWinnerCriteria['winc'] &&
            $table_winner['chip_difference'] == $finalWinnerCriteria['chip_difference'] &&
            $table_winner['player_chips'] > $finalWinnerCriteria['player_chips'])) {
            
            $finalWinner = $table_winner;
            $finalWinnerCriteria['winc'] = $table_winner['winc'];
            $finalWinnerCriteria['chip_difference'] = $table_winner['chip_difference'];
            $finalWinnerCriteria['player_chips'] = $table_winner['player_chips'];
        }
		if(!empty($finalWinner)){
		$update_array = array(
					'status' => 'over',
					'winner' => $finalWinner['winner']
				);

				$where = 'tournament_id='.$tournament_id;

				Db::updateQuery('tournaments',$update_array,$where);
				//ob_flush();
				echo 1;exit;
				//echo "hiiiii".SITEURL.'tournament-result.php?tid='.$tournament_id;
				//header('Location:'.SITEURL.'tournament-result.php?tid='.$tournament_id);exit;
		}// if there is a winner from list of tables updated him as winner 
		else{ // if no winner in previous win list 
			echo 2; exit;
			echo "hhhhhh";exit;
			echo '<script>
    var modal = document.getElementById("tableAddedModal");
    modal.style.display = "block";
	</script>';

		}
    }
	else{ // if no game over under this tournament /no winner  on tournamnet-table-players
		// echo "ggggg";exit;
		// Display the modal by echoing JavaScript

		echo 3;exit;
		echo '<script>
		document.addEventListener("DOMContentLoaded", function() {
        var modal = document.getElementById("tableAddedModal");
        modal.style.display = "block";
		});
		</script>';
	}
}

// The $finalWinner variable now holds the overall winner based on your criteria
echo "<pre/>";
print_r($finalWinner);
//update tournament table with status = over 
/*$update_array = array(
					'status' => 'over',
					'winner' => $finalWinner['winner']
				);

				$where = 'tournament_id='.$tournament_id;

				Db::updateQuery('tournaments',$update_array,$where);
				ob_flush();
				//echo "hiiiii".SITEURL.'tournament-result.php?tid='.$tournament_id;
				header('Location:'.SITEURL.'tournament-result.php?tid='.$tournament_id.'&win='.$finalWinner['winner']); */
		//==============================================================
			
		//}
		exit;
		//Print_r($result);
		
		
		return $result;
	}
		//======================================
		//========================================================
	function Split_winners_New($data)	
	{
		//print_r($data);exit;
		$tournament_id	=	$data['split_tournament_id'];
		$tabcount		=	$data['tabcount'];
		$upCount	=	$data['upCount'];
		$hasWinner	=	$data['hasWinner'];
		//var_dump($hasWinner);
		//echo $tournament_id.$tabcount.$upCount;
		if(($tabcount ==	1) && ($upCount <=1) && ($hasWinner === "1")){
			//echo "reached";		
		//echo $tournament_id;
			$result = array();
			Db::query('SELECT t.player_id,p.player_name FROM tournament_players as t LEFT JOIN player_database as p ON t.player_id = p.player_id WHERE t.tournament_id = :tournament_id AND t.player_status = :status GROUP BY player_id');
			//ob_flush();

			Db::execute(array(
				':tournament_id' => $tournament_id,
				':status' => 'active'
			));

			$result['active_players'] = Db::result();
			//print_r($result);exit;
			$playerNames = array(); // Initialize an array to store player names

			foreach ($result['active_players'] as $player) {
				// Append each player's name to the $playerNames array
				$playerNames[] = $player['player_name'];

				$insert_array = array(
					'winner'        => $player['player_id'],
					'tournament_id' => $tournament_id,
					'created_at'    => gmdate('Y-m-d h:i:s'),
					'updated_at'    => gmdate('Y-m-d h:i:s'),
				);

				Db::insertQuery('split_tables', $insert_array);
			}

			// Implode the player names with a separator (comma, space, etc.) to form a string
			$playerNamesString = implode(', ', $playerNames);

			$update_array = array(
				'status'   => 'over',
				't_status' => 1
			);

			$where = 'tournament_id='.$tournament_id;

			Db::updateQuery('tournaments', $update_array, $where);

		/*	$result['insert'] = array(
				'status'  => true,
				'message' => $playerNamesString,
			);
			*/
			$response = array(
					'status'  => true,
					'winners'  => $playerNamesString,					
					'message' => "Split called successfully"
				);
			//echo "1";exit;
			//echo "hiiiii".SITEURL.'tournament-result.php?tid='.$tournament_id;
			//header('Location:'.SITEURL.'tournament-result.php?tid='.$tournament_id);exit;
						
				// if(split_winner id == null)
					/*	else{
							if(!empty($result['active_player_count']))
								$result['1'] = $activeTableCount;
							if(!empty($result['active_table_count']))
								$result['2'] = $activePlayerCount;
							if(!empty($c))
								$result['3'] = $c;
						}*/
					//	print_r($response);exit;
		return $response;
		}
		else{
			echo "2";exit;
		}	
		
	}
		//==========================================================
	function Split_winners($data)
	{
		$result = array();
		$tournament_id = $data["tournament_id"];
	
		Db::query('SELECT table_id FROM tournament_tables WHERE tournament_id = :tournament_id');
	
		Db::execute(array(
			':tournament_id' => $tournament_id,
		));
	
		$result['tableIds'] = Db::result();
	
		$table_IDs = $result['tableIds'];
	
		$c = false; // Set initial value of $c as false

		foreach ($table_IDs as $table_ids_torney) {
			$tableID = $table_ids_torney['table_id'];
		
			Db::query('SELECT ttp.winner FROM tournament_tables_players AS ttp
						LEFT JOIN tournament_tables AS tt ON ttp.table_id = tt.table_id
						WHERE ttp.table_id = :table_id AND tt.tournament_id = :tournament_id GROUP BY ttp.winner');
		
			Db::execute(array(
				':table_id' => $tableID,
				':tournament_id' => $tournament_id
			));
		
			$winners = Db::result();
		
			// Store winners and their counts in the result array
			$result['table_winners'][$tableID]['winner'] = $winners;
			$result['table_winners'][$tableID]['count'] = count($winners);
		
			// Check if any winner is not null within the winner array
			foreach ($winners as $winner) {
				if ($winner['winner'] !== null) {
					$c = true;
					break; // Break the loop if a non-null winner is found
				}
			}
		}
		
		$result['has_non_null_winners'] = $c; // Store if any winner is not null
		
		//if $result['has_non_null_winners'] is true split can enable

		// select the player count from db
		Db::query('SELECT COUNT(player_status) AS active_player_count FROM tournament_players WHERE tournament_id = :tournament_id AND player_status = :status');
		//ob_flush();

		Db::execute(array(
		':tournament_id' => $tournament_id,
		':status' => 'active'
		));

		$result['active_player_count'] = Db::result(); 
		
		//select active table count
		Db::query('SELECT COUNT(table_id) AS active_table_count FROM tournament_tables WHERE tournament_id = :tournament_id AND status = :table_status');
		//ob_flush();

		Db::execute(array(
		':tournament_id' => $tournament_id,
		':table_status' => 'active'
		));

		$result['active_table_count'] = Db::result();
		
		$activeTableCount = $result['active_table_count'][0]['active_table_count'];
		$activePlayerCount = $result['active_player_count'][0]['active_player_count'];
		$c = $result['has_non_null_winners']; // Assuming $c is taken from this variable

		if (($c == true) && ($activePlayerCount <= 3) && ($activeTableCount == 1)) {
			
			// $result['helo'] = 'helo';
			
			Db::query('SELECT t.player_id,p.player_name FROM tournament_players as t LEFT JOIN player_database as p ON t.player_id = p.player_id WHERE tournament_id = :tournament_id AND player_status = :status GROUP BY player_id');
			//ob_flush();

			Db::execute(array(
				':tournament_id' => $tournament_id,
				':status' => 'active'
			));

			$result['active_players'] = Db::result();

			$playerNames = array(); // Initialize an array to store player names

			foreach ($result['active_players'] as $player) {
				// Append each player's name to the $playerNames array
				$playerNames[] = $player['player_name'];

				$insert_array = array(
					'winner'        => $player['player_id'],
					'tournament_id' => $tournament_id,
					'created_at'    => gmdate('Y-m-d h:i:s'),
					'updated_at'    => gmdate('Y-m-d h:i:s'),
				);

				Db::insertQuery('split_tables', $insert_array);
			}

			// Implode the player names with a separator (comma, space, etc.) to form a string
			$playerNamesString = implode(', ', $playerNames);

			$update_array = array(
				'status'   => 'over',
				't_status' => 1
			);

			$where = 'tournament_id='.$tournament_id;

			Db::updateQuery('tournaments', $update_array, $where);

			$result['insert'] = array(
				'status'  => true,
				'message' => $playerNamesString,
			);

			//echo "1";exit;
			//echo "hiiiii".SITEURL.'tournament-result.php?tid='.$tournament_id;
			//header('Location:'.SITEURL.'tournament-result.php?tid='.$tournament_id);exit;
		}
// if(split_winner id == null)
		else{
			if(!empty($result['active_player_count']))
				$result['1'] = $activeTableCount;
			if(!empty($result['active_table_count']))
				$result['2'] = $activePlayerCount;
			if(!empty($c))
				$result['3'] = $c;
		}

		return $result;
		
	}

// 	function Split_winners($data){
		
		
// 		$result = array();
// 		$tournament_id = $data["tournament_id"];

// 		Db::query('SELECT table_id FROM tournament_tables WHERE tournament_id = :tournament_id');
		
// 		Db::execute(array(
// 			':tournament_id' => $tournament_id,
// 		));

// 		$table_IDs = Db::result();
		
// 		//echo "<pre/>";print_r($table_IDs);exit;
// 	/*	foreach($table_IDs as $k => $table_ids_torney)
// 		{
// 			$tableID	=	$table_ids_torney['table_id'];
// 			echo "new".$tableID;
// 			//$tableID	=	1947;
// 			Db::query('SELECT ttp.winner, COUNT(winner) AS winc,tp.player_id, tp.player_decrement_chip,tp.player_starting_chip,(tp.player_starting_chip - tp.player_decrement_chip) AS chip_difference,pd.player_name, pd.player_chips, tp.player_status FROM tournament_tables_players AS ttp LEFT JOIN player_database pd ON ttp.winner=pd.player_id LEFT JOIN tournament_players tp ON tp.player_id=pd.player_id WHERE tp.tournament_id = :tournament_id AND tp.player_status = "active" AND ttp.`table_id` = :table_id Group BY `winner` order by winc desc,chip_difference asc,pd.player_chips DESC LIMIT 1');

// 			Db::execute(array(
// 				':table_id' => $tableID,
// 				':tournament_id' => $tournament_id,
// 			));
// 			$table_winners = Db::result();			
// 			echo "<pre/>";print_r($table_winners); */


// 		//================================================================
	
// //=================================
// $finalWinner = null;
// $finalWinnerCriteria = array('winc' => -1, 'chip_difference' => -1, 'player_chips' => -1);

// foreach ($table_IDs as $table_ids_torney) {
//     $tableID = $table_ids_torney['table_id'];
    
// 	Db::query('SELECT ttp.winner, COUNT(winner) AS winc,tp.player_id, tp.player_decrement_chip,tp.player_starting_chip,(tp.player_starting_chip - tp.player_decrement_chip) AS chip_difference,pd.player_name, pd.player_chips, tp.player_status FROM tournament_tables_players AS ttp LEFT JOIN player_database pd ON ttp.winner=pd.player_id LEFT JOIN tournament_players tp ON tp.player_id=pd.player_id WHERE tp.tournament_id = :tournament_id AND tp.player_status = "active" AND ttp.`table_id` = :table_id Group BY `winner` order by winc desc,chip_difference asc,pd.player_chips DESC');

//     Db::execute(array(
//         ':table_id' => $tableID,
//         ':tournament_id' => $tournament_id,
//     ));
//     $table_winners = Db::result();
//     //echo $tableID."From query";
// 	//echo "<pre/>";print_r($table_winners);
// 	//echo "/n===================================================/n";
//     // Your existing code to fetch table_winners goes here
	 
	
//     if (!empty($table_winners))
// 	{
//         $table_winner = $table_winners[0]; // Initialize with the first winner

//         foreach ($table_winners as $winner) {
//             if ($winner['winc'] > $table_winner['winc'] ||
//                 ($winner['winc'] == $table_winner['winc'] && $winner['chip_difference'] > $table_winner['chip_difference']) ||
//                 ($winner['winc'] == $table_winner['winc'] && $winner['chip_difference'] == $table_winner['chip_difference'] && $winner['player_chips'] > $table_winner['player_chips'])) {
//                 $table_winner = $winner;
//             }
//         }

//         // Compare the winner's attributes to determine the final winner
//         if ($table_winner['winc'] > $finalWinnerCriteria['winc'] ||
//             ($table_winner['winc'] == $finalWinnerCriteria['winc'] &&
//             $table_winner['chip_difference'] > $finalWinnerCriteria['chip_difference']) ||
//             ($table_winner['winc'] == $finalWinnerCriteria['winc'] &&
//             $table_winner['chip_difference'] == $finalWinnerCriteria['chip_difference'] &&
//             $table_winner['player_chips'] > $finalWinnerCriteria['player_chips']) && ) {
            
//             $finalWinner = $table_winner;
//             $finalWinnerCriteria['winc'] = $table_winner['winc'];
//             $finalWinnerCriteria['chip_difference'] = $table_winner['chip_difference'];
//             $finalWinnerCriteria['player_chips'] = $table_winner['player_chips'];

// 			$update_array = array(
// 					'status' => 'over',
// 					'winner' => $finalWinner['winner']
// 				);

// 				$where = 'tournament_id='.$tournament_id;

// 				Db::updateQuery('tournaments',$update_array,$where);
// 				//ob_flush();
// 				$response = array(
// 				'status' => true,
// 				'message' => $finalWinner['winner']
// 			);

// 			return $response;
// 				//echo "1";exit;
// 				//echo "hiiiii".SITEURL.'tournament-result.php?tid='.$tournament_id;
// 				//header('Location:'.SITEURL.'tournament-result.php?tid='.$tournament_id);exit;
//         }
// 		else{

// 			if($table_winners == '')
// 			{
// 			$response = array(
// 				'status' => false,
// 				'message' => "Tournament have no active player as winner to choose from previous games"
// 			);
// 			//return $response;
// 			//echo "2";exit;
// 			}
// 		}
// 		///////////////////////////////////////////////////

// 		}
// 	else{
// 		//if table_winner null is null
// 		if($table_winners == '')
// 		{
// 			$response = array(
// 				'status' => false,
// 				'message' => "Tournament have no active player as winner to choose from previous games"
// 			);
// 		}
// 
// 		return $response;
// 		//echo "3";exit;
// 		echo '<script>
//     var modal = document.getElementById("tableAddedModal");
//     modal.style.display = "block";
// </script>';

// 	}


// }

// // The $finalWinner variable now holds the overall winner based on your criteria
// //echo "<pre/>";
// //print_r($finalWinner);
// //update tournament table with status = over 

// 		//==============================================================
			
	
// 		//}
// 		exit;
// 		//Print_r($result);
		
// 		return $result;
// 	}
		//===============================================
	
	// function update_winner($data){

	// 	$result = array();
	// 	$tournament_id = $data['tournament_id'];

	// 	Db::query('SELECT t.tournament_id, t.table_id, t2.winner, t2.table_id FROM tournament_tables t LEFT JOIN tournament_tables_players t2 ON t.table_id=t2.table_id WHERE t.tournament_id=:tournament_id');
		
	// 	Db::execute(array(
	// 		':tournament_id' => $tournament_id,

	// 	));
	
	// 	$result['winners'] = Db::result();

	// 	return $result;
	// }

	function split_enable($data){

		$result = array();
		// $result= $data('tournament_id');
		$tournament_id = $data["tournament_id"];


		Db::query('SELECT table_id FROM tournament_tables WHERE tournament_id = :tournament_id');
		
		Db::execute(array(
			':tournament_id' => $tournament_id,
		));

		$result['table_id'] = Db::result();
		$tables = $result['table_id'];

		foreach($tables as $key=>$value){

		Db::query('SELECT winner FROM tournament_tables_players WHERE table_id=:table_id');

		Db::execute(array(
			':table_id' => $value['table_id'],
		));

		$result['winnervalues'] = Db::result();
		$winnersvalues = $result['winnervalues'];
		array_push($in_array,$value[$winnersvalues]);

		}
		
		if(in_array("NULL", $value[$winnersvalues]))
		{
			$winner_tables = "true";	
		}
		else
		{
			$winner_tables = "false";
		}
		$result['winnerstable'] = $winner_tables;
		return $result;
	}
	
	function sort_table($data)
	{
		$tableId1 = $data['draggedTableId'];
		$tableId2 = $data['droppedTableId'];
		$response = array();

		// Fetch sort_position for tableId1
		Db::query('SELECT sort_position FROM tournament_tables WHERE table_id = :tableID');
		Db::execute(array(
			':tableID' => $tableId1
		));
		$result1 = Db::result();

		if ($result1) {
			$position1 = $result1[0]['sort_position'];

			// Fetch sort_position for tableId2
			Db::query('SELECT sort_position FROM tournament_tables WHERE table_id = :tableID');
			Db::execute(array(
				':tableID' => $tableId2
			));
			$result2 = Db::result();

			if ($result2) {
				$position2 = $result2[0]['sort_position'];

				// Swap positions in the database using UPDATE queries
				Db::query('UPDATE tournament_tables SET sort_position = :position1 WHERE table_id = :tableId1');
				Db::execute(array(
					':position1' => $position2,
					':tableId1' => $tableId1
				));
				$response['sort1'] = $position2;

				Db::query('UPDATE tournament_tables SET sort_position = :position2 WHERE table_id = :tableId2');
				Db::execute(array(
					':position2' => $position1,
					':tableId2' => $tableId2
				));
				$response['sort2'] = $position1;

				return $response;
			}
		}

		return false; // when positions are not found for given table IDs
	}
	// Function to check if at least one winner is present
function hasWinner($table)
{
    foreach ($table['players'] as $player) {
        if (!empty($player['winner'])) {
            return true; // At least one winner found
        }
    }
    return false; // No winner found
}


}
?>