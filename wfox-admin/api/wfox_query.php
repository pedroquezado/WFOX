<?php
	/*
	$listArray = array(
		'p_visibilidade' => 'V',
		'p_data' => '2017-03-02',
		);
	*/

	function sql_where(Array $listArray = null, $stri = ' AND '){
		$return = '';
		if( !is_null($listArray) ){

			if (count($listArray) > 0) {
	            foreach ($listArray as $key => $value) {
	                $value = "'$value'";
	                $updates[] = "`$key`=:$key";
	            }
	        }

	        $implodeArray = implode($stri, $updates);

	        $return = 'WHERE ' . $implodeArray;
	    }

        return $return;

    }


	function sql_query($type = null, $query = null, $table = null, Array $bind = null){
		/*
			TYPE 	-> TIPO DE QUERY "SELECT, INSERT, DELET"
			QUERY 	-> SE NULL A FUNÇÃO PEGARÁ A "TABLE" E CRIRAR UM QUERY
			TABLE 	-> TABELA PARA LOCALIZAÇÃO
			BIND 	-> LISTAGEM DO ARRAY QUE REPRESENSA O VALOR BIND E A COLUNA DA TABELA ('t_teste'=:t_teste  >>  value)
		*/

		// NOVA CONECÇÃO
		$pdo = getConnection();

		// SE QUERY TYPE == 'SELECT'
		if( !is_null($type) && $type == 'select' ){ 

			// SE EXISTIR A STRING 'QUERY'
			if( !is_null($query) && $query != ''){

				// QUERY -> "SELECT * FROM teste WHERE teste=:teste"
				$stmt = $pdo->prepare($query); // PREPARA A STMT


			// SE NÃO EXISTIR A STRING 'QUERY'
			} else {

				// VARIAVEL SQL_WHERE
				$sql_where = '';
				if( !is_null($bind) && $bind != ''){
					$sql_where = sql_where($bind);
				}

   				$select = "SELECT * FROM `{$table}` {$sql_where}";
   				$stmt = $pdo->prepare($select);

			}

			if( !is_null($bind) && $bind != ''){
				foreach ($bind as $key => $value) {
					$stmt->BindValue(':'.$key, $value);
				}
			}

			$stmt->execute();

			$return = $stmt->fetchAll(PDO::FETCH_OBJ);
		}

		return $return;

	}



	/*
	$posts = sql_query('select',null,'posts',$listArray);

	foreach($posts as $post){
		echo  $post->p_data . ' - ' . $post->p_titulo . '<br>';
	}
	*/