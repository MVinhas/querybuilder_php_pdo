<?php

require_once 'Select.php';
require_once 'Db.php';

$query = (new Select('customers.id'))
->from('customers LEFT JOIN persons')
->on(['customers.person_id','=','persons.id'])
->where(['customers.name', '=', '"David"'])
->limit(1)->fetch();
