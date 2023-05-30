<?php
$inputData = array(
    'list_info' => array(
        'sort_field' => 'id',
        'sort_order' => 'asc',
        'get_total_count' => true,
        'search_fields' => array(
            'requester.id' => '11'
        )
    )
);


?>


<form action="https://localhost:8080/api/v3/requests?input_data=<?php echo json_encode($inputData)?>" method="POST">
    <input type="hidden" name="authtoken" value="5EAEBCE0-93C8-4D06-AEA8-48EB35305D44">
    <input type="submit">
</form>


