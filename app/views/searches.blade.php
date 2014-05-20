<link rel="stylesheet" type="text/css" href="assets/css/jquery.dataTables.css">
<script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>

    {{ Datatable::table()
    ->addColumn('search', 'created_at')       // these are the column headings to be shown
    ->setUrl(route('api.searches'))   // this is the route where data will be retrieved
    ->render() }}