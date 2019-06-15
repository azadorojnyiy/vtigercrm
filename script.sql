SET @linkid = (SELECT id+1 FROM vtiger_links_seq);
SET @Home_tab_id = (SELECT DISTINCT tabid FROM vtiger_tab WHERE name='Home');
INSERT INTO vtiger_links VALUES (@linkid, @Home_tab_id, 'DASHBOARDWIDGET','MyWidget','index.php?module=MyModule&view=ShowWidget&name=Test','',20,NULL,NULL,NULL,NULL);
UPDATE vtiger_links_seq SET id = @linkid;