(function() {
	var dataID = document.getElementById("helper").getAttribute("data-id");
/*
	listGames = function(){
		var myDB = systemDB;
		
		myDB.transaction(
		    function (transaction) {
				transaction.executeSql("SELECT * from games;", [], function (transaction, results) {
					// console.log('---------- Games -----------');
					for(var i=0; i<results.rows.length; i++) {
						var row = results.rows.item(i);
						gamesList.push(row);
						// console.log(row);
					};
					// console.log('---------- end -----------');

					// trigger event callback
	                var evt = new CustomEvent('get games complete', {detail: gamesList});
				    topCanvas.dispatchEvent(evt);
				}, errorHandler);
		    }
		);

	};

	listLeaderboard = function(today){
		var myDB = systemDB;
		
		myDB.transaction(
		    function (transaction) {
				transaction.executeSql("SELECT u.id, u.name, g.score FROM users u, games g WHERE u.id = g.user_id AND g.created > ? GROUP BY g.user_id ORDER BY score DESC LIMIT 10;", [today], function (transaction, results) {
					
					for(var i=0; i<results.rows.length; i++) {
						var row = results.rows.item(i);
						leaderboardList.push(row);
						// console.log(row);
					};

					// trigger event callback
	                var evt = new CustomEvent('get leaderboard complete', {detail: leaderboardList});
				    topCanvas.dispatchEvent(evt);
				}, errorHandler);
		    }
		);

	};
*/
	getSpinSettings = function(){
		$.ajax({
			type: "POST", //we are using GET method to get all record from the server
			url: './php/db_spin_settings.php', // get the route value
			data: {dataID: dataID}, // our serialized array data for server side
			success: function (response) {//once the request successfully process to the server side it will return result here
				response = JSON.parse(response);
				console.log(response);
				var row = response;

				spinSettings.push(row);
			}
		});
	}

	getPrizes = function(){
		$.ajax({
			type: "POST", //we are using GET method to get all record from the server
			url: './php/db.php', // get the route value
	        data: {dataID: dataID}, // our serialized array data for server side
			success: function (response) {//once the request successfully process to the server side it will return result here
				response = JSON.parse(response);
				rawWheelData.length = 0;
				for(var i=0; i<response.length; i++) {
					var row = response[i];
					rawWheelData.push(row);
				};
				var evt = new CustomEvent('get prizes complete', {detail: rawWheelData});
				mainCanvas.dispatchEvent(evt);
			}
		});
	}

	updatePrizes = function(prizeList){

		$.ajax({
	        type: "POST", //we are using POST method to submit the data to the server side
	        url: './php/update.php', // get the route value
	        data: {myData: prizeList, dataID: dataID}, // our serialized array data for server side
	        success: function (response) {//once the request successfully process to the server side it will return result here
				// console.log(response);

				rawWheelData.length = 0;
				for(var i=0; i<response.length; i++) {
					var row = response[i];
					rawWheelData.push(row);
				};
				var evt = new CustomEvent('update prizes complete', {detail: rawWheelData});
				mainCanvas.dispatchEvent(evt);

	        }
	    });
	};

	saveGames = function(wheelResult, newQuantity, starttimeRef, endtimeRef, createdRef, isGameover){
		var user_id = document.getElementById('spinsid').value;
		$.ajax({
	        type: "POST", //we are using POST method to submit the data to the server side
	        url: './php/save.php', // get the route value
	        data: {dataID: dataID, user_id: user_id, myData: [{'wheelResult' : wheelResult, 'newQuantity' : newQuantity, 'starttimeRef': starttimeRef, 'endtimeRef':endtimeRef, 'createdRef':createdRef, 'isGameover': isGameover}]}, // our serialized array data for server side
	        success: function (response) {//once the request successfully process to the server side it will return result here
				// console.log(response);
	        }
	    });

	};

	// numberspins = function(){
	// 	$.ajax({
	// 		type: "GET",
	// 		url: "./php/get.php",
	// 		data: {dataID:7},
	// 		dataType: "dataType",
	// 		success: function (response) {
	// 			console.log(response);
	// 			$(".noSpins").val(response)
	// 		}
	// 	});
	// };

	numberspins = function(dataID){
		var html = '';
		var link = '';

		$.ajax({
			type: "POST",
			url: "./php/updatespin.php",
			data: {dataID:dataID},
			// dataType: "dataType",
			success: function (response) {
				if (response > 0 ) {
					console.log('success response',response);
					html += ` ${response}`
					// modalspin += ` ${response} `
					$(".noSpins").html(html);
					$(".numberSpin").html(html);
				}else{
					console.log('success response but is 0 spins   ',response);
					html += ` ${response}`
					// modalspin += ` ${response} `
					$(".noSpins").html(html);
					$(".numberSpin").html(html);
					
					link = './term.php';
					$("#nextpage").attr('href', link);
					$("#nextpage").html('Next');
				}
			}
		});
	};

	tempRecord = function(dataID){


		$.ajax({
			type: "POST",
			url: ".php/tempSpin.php",
			data: {user_id:dataID},
			success: function (response) {
				
			}
		});
	};
	
	// initDB = function(){
	// 	try {
	// 	    if (!window.openDatabase) {
	// 	        alert('not supported');
	// 	    } else {
	// 	        var shortName = 'wheelDB';
	// 	        var version = '1.0';
	// 	        var displayName = 'User record DB';
	// 	        var maxSize = 8*1024*1024; // in bytes
	// 	        var myDB = openDatabase(shortName, version, displayName, maxSize);

	// 	        // You should have a database instance in myDB.

	// 	    }
	// 	} catch(e) {
	// 		console.log(e);
	// 	    // Error handling code goes here.
	// 	    if (e == INVALID_STATE_ERR) {
	// 	        // Version number mismatch.
	// 			alert("Invalid database version.");
	// 	    } else {
	// 			alert("Unknown error "+e+".");
	// 	    }
	// 	    return;
	// 	}

	// 	// alert("Database is: "+myDB);

	// 	createTables(myDB);
	// 	systemDB = myDB;
	// };

	/*! This creates the database tables. */
	createTables = function(db){
		/* To wipe out the table (if you are still experimenting with schemas,
		   for example), enable this block. */
		if (0) {
			db.transaction(
			    function (transaction) {
					transaction.executeSql('DROP TABLE games;');
					transaction.executeSql('DROP TABLE prizes;');
			    }
			);
		}

		db.transaction(
		    function (transaction) {
		        transaction.executeSql('CREATE TABLE IF NOT EXISTS games(id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, wheel_result INTEGER NOT NULL, starttime DATETIME NOT NULL, endtime DATETIME NOT NULL, created DATETIME NOT NULL, status INTEGER NOT NULL DEFAULT 1);', [], nullDataHandler, killTransaction);
		        transaction.executeSql('CREATE TABLE IF NOT EXISTS prizes(id INTEGER NOT NULL PRIMARY KEY, name TEXT NOT NULL, quantity INTEGER NOT NULL, rate_min INTEGER NOT NULL, rate_max INTEGER NOT NULL, is_gameover INTEGER NOT NULL, created DATETIME NOT NULL);', [], nullDataHandler, errorHandler);
		    }
		);
	};
	/*! When passed as the error handler, this silently causes a transaction to fail. */
	killTransaction = function(transaction, error){
		return true; // fatal transaction error
	};
	/*! When passed as the error handler, this causes a transaction to fail with a warning message. */
	errorHandler = function(transaction, error){
	    // Error is a human-readable string.
	    alert('Oops.  Error was '+error.message+' (Code '+error.code+')');

	    // Handle errors here
	    var we_think_this_error_is_fatal = true;
	    if (we_think_this_error_is_fatal) return true;
	    return false;
	};

	/*! This is used as a data handler for a request that should return no data. */
	nullDataHandler = function(transaction, results){};

}());