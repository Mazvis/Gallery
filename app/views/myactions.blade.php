<link rel="stylesheet" type="text/css" href="assets/css/jquery.dataTables.css">
<script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>

{{ Datatable::table()
->addColumn('Action', 'IP', 'Date')       // these are the column headings to be shown
->setUrl(route('api.myactions'))   // this is the route where data will be retrieved
->render() }}