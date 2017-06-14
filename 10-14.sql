UPDATE masterkatagori SET packge_price = 150000

38  ase, INT,

SELECT id_mem, GROUP_CONCAT(CONCAT ('''',id_category ),'''') AS cate 
FROM paket_user WHERE id_mem = 38 GROUP BY id_mem

SELECT * FROM masterkatagori WHERE ID_CATEGORY IN (SELECT id_mem, GROUP_CONCAT(CONCAT ('''',id_category ),'''') AS cate 
FROM paket_user WHERE id_mem = 38 GROUP BY id_mem)

SELECT SUM(a.packge_price) AS total_amount FROM masterkatagori a,paket_user b
WHERE a.ID_CATEGORY = b.id_category AND b.id_mem = 53

DELETE FROM memberbaru WHERE user_name = 'jos'

paket_user