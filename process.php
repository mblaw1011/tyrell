<?php

	$n = intval($_POST['number_of_people']);
	
	
	echo json_encode(distributeCard($n));
	


    function distributeCard($n)
    {
        $min = 1;
        $max = 52;
		
		$ret = array();

		$n = intval($n);

        //assume that n must > 0 and <= 52
        if ($n < $min || $n > $max) 
		{
			http_response_code(422 );
            echo 'Input value does not exist or value is invalid';
            exit;
        }
		
		$cards = generateCard();
		
		$card_count_per_head = intval(count($cards) / $n);
		
		shuffle($cards);
		
        for ($i = 0; $i < $n; $i++) 
		{
            array_push($ret, array_slice($cards, $i * $card_count_per_head, $card_count_per_head));
        }
		
        return $ret;
    }
	
	
	function generateCard() 
	{
		$min = 1;
		$max = 13;
		$cards = array();
		
        $shapes = array(
            'S' => 'Spade',
            'H' => 'Heart',
            'D' => 'Diamond',
            'C' => 'Club',
        );
        
        foreach (range($min, $max) as $item) 
		{
            switch ($item) 
			{
                case 1:
                    $item = 'A';
                    break;
                case 10:
                    $item = 'X';
                    break;
                case 11:
                    $item = 'J';
                    break;
                case 12:
                    $item = 'Q';
                    break;
                case 13:
                    $item = 'K';
                    break;
            }

            foreach ($shapes as $key => $shape) 
			{
                array_push($cards, strtoupper($key) . '-' . $item);
            }
        }
		
		return $cards;
	}
