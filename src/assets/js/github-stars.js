(function(exports) {
	exports.githubStars = function (repo, callback) {
		var xmlhttp = new XMLHttpRequest(),
			url = ["https://api.github.com"],
			useCallback = (typeof(callback) == "function");

		//count the stars
		function countStars(response) {
			//don't care, just make it an array
			if (!(response instanceof Array)) {
				response = [response];
			}
			//start the count
			var stars = 0;

			for (var i in response) {
				stars += parseInt(response[i].stargazers_count);
			}

			return stars;
		}

		//determine if we're looking at a collection or a single repo
		repo = repo.split("/");

		if (repo.length === 1) {
			url.push("users", repo[0], "repos");
		} else {
			url.push("repos", repo[0], repo[1]);
		}

		//check if we were given a callback, if so we set that up
		if (useCallback) {
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					callback(countStars(JSON.parse(xmlhttp.responseText)));
				}
			}
		}

		xmlhttp.open("GET", url.join("/"), useCallback);
		//set the github media header
		xmlhttp.setRequestHeader("Accept", "application/vnd.github.v3+json");
		xmlhttp.send();

		if (!useCallback) {
			//no callback, just wait for the response
			return countStars(JSON.parse(xmlhttp.responseText));
		}
	}
})(typeof exports !== 'undefined' ? exports : window);