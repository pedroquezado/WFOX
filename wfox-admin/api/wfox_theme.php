<?php

	/**
	* FUNÇÕES DO BLOG
	* DECLARAÇÃO - WFOX
	* v1.0
	*/
	
	function get_bloginfo( $display ) {
		switch ($display) {
			case 'url':
				$outGet = WFOX_SITE_URL;
				break;

			case 'url_theme':
				$outGet = WFOX_SITE_FTHEME;
				break;

			case 'name':
				$outGet = WFOX_SITE_NAME;
				break;

			case 'description':
				$outGet = WFOX_SITE_RESUMO;
				break;

			case 'language':
				$outGet = WFOX_SITE_IDIOMA;
				break;

			case 'post_by_page':
				$outGet = WFOX_SITE_TOTALPAGE;
				break;
			
			default:
				$outGet = 'ERROR';
				break;
		}

		return $outGet;
	}

	function blog_info( $return ) {
		echo get_bloginfo($return);
	}


	// ** SISTEMA DE INCLUSÃO DE ARQUVISO ** //

	// VALIDADOR
	function local_file( $file, $type ) {
		/**
		* Validação de existencias de arquivos para INCLUDES
		*/
		if( file_exists($file) && $type == 'page' ) {
			require( $file );

		} elseif( file_exists($file) && $type == 'link' ){
			$rLink = return_theme( $file );
			echo WFOX_SITE_FTHEME . '/' . $rLink;
		} else {
			echo 'ERROR::LOAD_FILLE >> ARQUIVO NÃO DEFINIDO';
		}
	}

	// SOLICITAÇÃO DO ARQUIVO HEADER
	function get_header( $return = null ) {
		/**
		* Apos a solicitação ele analisa o paremetro $return que é null,
		* Se o retorno permanever vazio ele printara a solicitação padrão,
		* contrario a isso ele retornara o valor aberto (/page-{$return}.php);
		*/

		$loadFile = WFOX_SITE_THEME . "/header.php"; // SOLICITAÇÃO PADRÃO

		if( $return != null ){
			$loadFile = WFOX_SITE_THEME . "/header-{$return}.php"; // SOLICITAÇÃO VALOR ABERTO
		}

		// Envia o retorno para a verificação da existencia do arquivo.
		local_file( $loadFile, 'page' );
	}

	// SOLICITAÇÃO DO ARQUIVO FOOTER
	function get_footer( $return = null ) {
		/**
		* Apos a solicitação ele analisa o paremetro $return que é null,
		* Se o retorno permanever vazio ele printara a solicitação padrão,
		* contrario a isso ele retornara o valor aberto (/page-{$return}.php);
		*/

		$loadFile = WFOX_SITE_THEME . "/footer.php"; // SOLICITAÇÃO PADRÃO

		if( $return != null ){
			$loadFile = WFOX_SITE_THEME . "/footer-{$return}.php"; // SOLICITAÇÃO VALOR ABERTO
		}

		// Envia o retorno para a verificação da existencia do arquivo.
		local_file( $loadFile, 'page' );
	}

	// SOLICITAÇÃO DO ARQUIVO FOOTER
	function get_sidebar( $return = null ) {
		/**
		* Apos a solicitação ele analisa o paremetro $return que é null,
		* Se o retorno permanever vazio ele printara a solicitação padrão,
		* contrario a isso ele retornara o valor aberto (/page-{$return}.php);
		*/

		$loadFile = WFOX_SITE_THEME . "/sidebar.php"; // SOLICITAÇÃO PADRÃO

		if( $return != null ){
			$loadFile = WFOX_SITE_THEME . "/sidebar-{$return}.php"; // SOLICITAÇÃO VALOR ABERTO
		}

		// Envia o retorno para a verificação da existencia do arquivo.
		local_file( $loadFile, 'page' );
	}

	function get_search( $return = null ) {
		/**
		* Apos a solicitação ele analisa o paremetro $return que é null,
		* Se o retorno permanever vazio ele printara a solicitação padrão,
		* contrario a isso ele retornara o valor aberto (/page-{$return}.php);
		*/

		$loadFile = WFOX_SITE_THEME . "/search.php"; // SOLICITAÇÃO PADRÃO

		if( $return != null ){
			$loadFile = WFOX_SITE_THEME . "/search-{$return}.php"; // SOLICITAÇÃO VALOR ABERTO
		}

		// Envia o retorno para a verificação da existencia do arquivo.
		local_file( $loadFile, 'page', 'page' );
	}

	// OBETER O LINK CSS
	function get_style( $return = null ) {
		$loadFile = WFOX_SITE_THEME . "/style.css"; // SOLICITAÇÃO PADRÃO

		// Envia o retorno para a verificação da existencia do arquivo.
		local_file( $loadFile, 'link' );
	}

	// OBETER O LINK ICON
	function get_icon( $return = 'ico' ) {
		$loadFile = WFOX_SITE_THEME . "/favicon.{$return}"; // SOLICITAÇÃO PADRÃO

		// Envia o retorno para a verificação da existencia do arquivo.
		local_file( $loadFile, 'link' );
	}

	function get_posts( $quantidade = 5, $apartir = 0, $cat_id = null, $search = null ) {
		$pdo = getConnection();

		$paged = _get('page');
		if ( $paged ) {
			$apartir = ( $paged - 1) * $quantidade;
		}

		// BUSCAR POSTS POR CATEGORIAS
		if ( !is_null($cat_id) && is_numeric($cat_id) ) {
			$stmt = $pdo->prepare("SELECT * FROM posts, post_categories 
								   WHERE posts.p_id = post_categories.pc_post_id 
								   AND post_categories.pc_cat_id = :cat_id ORDER BY p_data DESC, p_hora DESC 
								   LIMIT {$apartir}, {$quantidade}");
			$stmt->BindValue(':cat_id', $cat_id);
			$stmt->execute();

			$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

		// BUSCAR POSTS POR FILTRO DE PESQUISA
		} elseif( !is_null($search) && $search != '' ){
			$condicoes = "(`p_visibilidade`=:visib) AND ((`p_titulo` LIKE '%{$search}%') OR ('%{$search}%'))";
			$stmt = $pdo->prepare("SELECT * FROM `posts` WHERE {$condicoes} ORDER BY p_data DESC, p_hora DESC LIMIT {$apartir}, {$quantidade}");
			$stmt->bindValue(':visib', 'V');
			$stmt->execute();

			$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

		// BUSCA PADRÃO
		} else {
			$stmt = $pdo->prepare("SELECT * FROM `posts` WHERE `p_visibilidade`=:visib ORDER BY p_data DESC, p_hora DESC LIMIT {$apartir}, {$quantidade}");
			$stmt->bindValue(':visib', 'V');
			$stmt->execute();

			$posts = $stmt->fetchAll(PDO::FETCH_OBJ);
		}

		return $posts;
	}

	function get_post( $url ) {
		$pdo = getConnection();
	
		$stmt = $pdo->prepare("SELECT * FROM `posts` WHERE `p_link`=?");
		$stmt->execute(array($url));
		$post = $stmt->fetch(PDO::FETCH_ASSOC);
		
		return $post;
	}

	function get_category( $postID = null, $limite = null ) {
		$pdo = getConnection();

		if($postID != null && is_null($limite)){
			$stmt = $pdo->prepare("SELECT * FROM `post_categories` WHERE `pc_post_id`=:postID");
			$stmt->bindValue(':postID', $postID);
			$stmt->execute();

			$cadegorys = $stmt->fetchAll(PDO::FETCH_OBJ);

		} elseif($postID != null && $limite != null){
			$stmt = $pdo->prepare("SELECT * FROM `post_categories` WHERE `pc_post_id`=:postID LIMIT {$limite}");
			$stmt->bindValue(':postID', $postID);
			$stmt->execute();

			$cadegorys = $stmt->fetch(PDO::FETCH_ASSOC);

		} else {
			$stmt = $pdo->prepare("SELECT * FROM `categories`");
			$stmt->execute();

			$cadegorys = $stmt->fetchAll(PDO::FETCH_OBJ);
		}

		return $cadegorys;
	}

	function get_author( $id_u ) {
		$pdo = getConnection();
		return retornaDadosUser($pdo,$id_u,'nCompleto');
	}

	function get_author_type($id, $return){
		$pdo = getConnection();
		echo retornaDadosUser($pdo, $id, $return);
	}

	function get_author_thumb( $id ){
		$pdo = getConnection();
		$thumb = getThumbProfil($pdo, $id);
		return $thumb;
	}

	function post_reduzi( $string, $max ) {
		// Tira tags para evitar quebrar qualquer html
		$string = strip_tags($string);

		if (strlen($string) > $max) {

		    // truncate string
		    $stringCut = substr($string, 0, $max);

		    $string = substr($stringCut, 0, strrpos($stringCut, ' ')) . '...'; 
		}
		echo $string;
	}

	function get_link( $link ) {
		return WFOX_SITE_URL . '/' . strtolower($link);
	}

	function page_active( $page = '' ) {
		$view = _get('view');

		$pageActive = '';
		if($page == $view) {
			$pageActive = 'page_active';
		}

		return $pageActive;
	}

	function get_ifpost( $post = null ){
		if($post['p_visibilidade'] == 'V'){
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function get_thumb( $thumbID ) {
		return getThumb(null, $thumbID);
	}

	function pagination( $total_reg, $cat_id = null, $search = null ){
		$pdo = getConnection();

		$busca = "SELECT COUNT(*) FROM `posts` WHERE `p_visibilidade`=:visib";
		if ( !is_null($cat_id) && is_numeric($cat_id)) {
			$busca = "SELECT COUNT(*) FROM posts, post_categories 
					  WHERE posts.p_visibilidade=:visib 
					  AND posts.p_id = post_categories.pc_post_id 
					  AND post_categories.pc_cat_id = :cat_id";
		}

		if( !is_null($search) && $search != '' ){
			$condicoes = "(`p_visibilidade`=:visib) AND ((`p_titulo` LIKE '%{$search}%') OR ('%{$search}%'))";
			$busca = "SELECT COUNT(*) FROM `posts` WHERE {$condicoes}";
		}

		$pagina = _get('page');
		if (!$pagina) {
			$pc = "1";
		} else {
			$pc = $pagina;
		}

		$inicio = $pc - 1;
		$inicio = $inicio * $total_reg;

		$limite = $pdo->prepare("{$busca} LIMIT {$inicio}, {$total_reg}");
		$limite->bindValue(':visib', 'V');
		if ( !is_null($cat_id) && is_numeric($cat_id) ) {
			$limite->BindValue(':cat_id', $cat_id);
		}
		$limite->execute();

		$todos = $pdo->prepare("{$busca}");
		$todos->bindValue(':visib', 'V');
		if ( !is_null($cat_id) && is_numeric($cat_id) ) {
			$todos->BindValue(':cat_id', $cat_id);
		}
		$todos->execute();

		$tr = $todos->fetchColumn(); // verifica o número total de registros
		$tp = $tr / $total_reg; // verifica o número total de páginas

		// agora vamos criar os botões "Anterior e próximo"
		$anterior = $pc -1;
		$proximo = $pc +1;
		if ($pc>1) {
			$rAnt = "<a href='?page=$anterior'>Anterior</a>";
			if( !is_null($search) && $search != '' ){
				$rAnt = "<a href='?s={$search}&page=$anterior'>Anterior</a>";
			}
			echo $rAnt;
		}
		if ($pc<$tp) {
			$rProx = "<a href='?page=$proximo'>Próxima</a>";
			if( !is_null($search) && $search != '' ){
				$rProx = "<a href='?s={$search}&page=$proximo'>Próxima</a>";
			}
			echo $rProx;
		}
	}

	function post_related( $limite = 2 ){
		$pdo = getConnection();

		$pagina = _view(0);
		$post = get_post( $pagina );

		$category = get_category($post['p_id'], '1');

		$select = "SELECT * FROM posts, post_categories 
				   WHERE posts.p_id = post_categories.pc_post_id 
				   AND post_categories.pc_cat_id = :cat_id
				   ORDER BY rand() LIMIT {$limite}";
		$statement = $pdo->prepare($select);
		$statement->BindValue(':cat_id', $category['pc_cat_id']);
		$statement->execute();

		$posts = $statement->fetchAll();

		return $posts;
	}

	function get_meta( $line ){
		switch ($line) {
			// META SITE
			case 'description':
				$return_line = '<meta name="description" content="" />';
				break;
			case 'news_keywords':
				$return_line = '<meta name="news_keywords" content="" />';
				break;
			case 'original-source':
				$return_line = '<meta name="original-source" content="" />';
				break;

			// LINK SITE
			case 'canonical':
				$return_line = '<link rel="canonical" href="" />';
				break;
			case 'publisher':
				$return_line = '<link rel="publisher" href="" />';
				break;

			// META:OG
			case 'og:locale':
				$return_line = '<meta property="og:locale" content="en_US" />';
				break;
			case 'og:type':
				$return_line = '<meta property="og:type" content="article" />';
				break;
			case 'og:title':
				$return_line = '<meta property="og:title" content="SEO Guide: HTML Code &amp; Search Engine Success Factors" />';
				break;
			case 'og:description':
				$return_line = '<meta property="og:description" content="Search Engine Land&#039;s Guide to SEO Chapter 3: HTML Code &amp; Search Engine Ranking Success Factors explains HTML elements &amp; using structured data." />';
				break;
			case 'og:url':
				$return_line = '<meta property="og:url" content="http://searchengineland.com/guide/seo/html-code-search-engine-ranking" />';
				break;
			case 'og:site_name':
				$return_line = '<meta property="og:site_name" content="Search Engine Land" />';
				break;
			case 'og:image':
				$return_line = '<meta property="og:image" content="http://searchengineland.com/figz/wp-content/seloads/2011/06/periodic-table-of-seo-2015.png" />' ;
				break;
			case 'og:image:width':
				$return_line = '<meta property="og:image:width" content="1224" />';
				break;
			case 'og:image:height':
				$return_line = '<meta property="og:image:height" content="918" />';
				break;

			// META ARTICLE
			case 'article:publisher':
				$return_line = '<meta property="article:publisher" content="https://www.facebook.com/searchengineland" />';
				break;
			case 'article:author':
				$return_line = '<meta property="article:author" content="https://www.facebook.com/dannysullivan" />';
				break;

			// META FACEBOOK
			case 'fb:app_id':
				$return_line = '<meta property="fb:app_id" content="108479729193136" />';
				break;
			case 'fb:admins':
				$return_line = '<meta property="fb:admins" content="684476602, 1269303818, 679476803, 549118759"/>';
				break;
			case 'fb:page_id':
				$return_line = '<meta property="fb:page_id" content="7138936668" />';
				break;

			// META TWITTER
			case 'twitter:card':
				$return_line = '<meta name="twitter:card" content="summary_large_image" />';
				break;
			case 'twitter:description':
				$return_line = '<meta name="twitter:description" content="Search Engine Land&#039;s Guide to SEO Chapter 3: HTML Code &amp; Search Engine Ranking Success Factors explains HTML elements &amp; using structured data." />';
				break;
			case 'twitter:title':
				$return_line = '<meta name="twitter:title" content="SEO Guide: HTML Code &amp; Search Engine Success Factors" />';
				break;
			case 'twitter:site':
				$return_line = '<meta name="twitter:site" content="@sengineland" />';
				break;
			case 'twitter:image':
				$return_line = '<meta name="twitter:image" content="http://searchengineland.com/figz/wp-content/seloads/2011/06/periodic-table-of-seo-2015.png" />';
				break;
			case 'twitter:creator':
				$return_line = '<meta name="twitter:creator" content="@dannysullivan" />';
				break;
			case 'twitter:app:country':
				$return_line = '<meta name="twitter:app:country" content="US">';
				break;
			case 'twitter:app:name:iphone':
				$return_line = '<meta name="twitter:app:name:iphone" content="Search Engine Land">';
				break;
			case 'twitter:app:id:iphone':
				$return_line = '<meta name="twitter:app:id:iphone" content="1015557452">';
				break;
			case 'twitter:app:name:ipad':
				$return_line = '<meta name="twitter:app:name:ipad" content="Search Engine Land">';
				break;
			case 'app:id:ipad':
				$return_line = '<meta name="twitter:app:id:ipad" content="1015557452">';
				break;
			case 'twitter:app:name:googleplay':
				$return_line = '<meta name="twitter:app:name:googleplay" content="Search Engine Land">';
				break;
			case 'twitter:app:id:googleplay':
				$return_line = '<meta name="twitter:app:id:googleplay" content="com.thirddoormedia.searchengineland">';
				break;

			// LINE -> NULL
			default:
				$return_line = 'ERROR::LOAD_META >> META NÃO DEFINIDA';
				break;
		}

		return $return_line;
	}
