SELECT
  t1.id as table_1_id, t1.name as table_1_name, t2.id as table_2_id, t2.name as table_2_name
FROM
  tableA t1
INNER JOIN
  tableB t2
ON
  t1.name=t2.name ORDER BY t1.name ASC;


============================================================================================


SELECT
  t1.id as table_1_id, t1.name as table_1_name, t2.id as table_2_id, t2.name as table_2_name
FROM
  tableA t1
FULL OUTER JOIN
  tableB t2
ON
  t1.id=t2.id;



