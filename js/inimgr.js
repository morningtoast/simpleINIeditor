/*
	Simple INI Editor
	Methods for front-end actions.
*/
			var iniManager = {
				
				"newGroup": function() {
					var groupHash = this.getHash(8);
					var tmpl      = $("#tmpl-group").html();
					var render    = Mustache.to_html(tmpl, {"hash":groupHash});
					
					$("#list").append(render);
					
					this.newPair(groupHash);
				},
				
				"newPair": function(hash, key, value) {
					$("#group-"+hash+" .pair-list").append(this.viewItem(key, value, hash));
				},
				
				"html": function() {
					var tmpl = $("#tmpl-group").html();
					for (var key in this.loaded) {
						var groupHash = this.getHash(8);
					
						var data = {
							"hash":  groupHash,
							"group": key,
							"pairs": this.loaded[key],
							"items": ""
						}

						var render = Mustache.to_html(tmpl, data);
						
						$("#list").append(render);
						
						$.each(data.pairs, function(key, value) {
							iniManager.newPair(groupHash,key, value);
						});
					}				
				
				},
				
				"viewItem": function(key, value, hash) {
					var data = {
						"key":key,
						"value":value,
						"hash":hash
					}
					var tmpl   = $("#tmpl-item").html();
					var render = Mustache.to_html(tmpl, data);

					return(render);
				},
				
				"getHash": function(size) {
					var text    = "";
					var charset = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

					for( var i=0; i < size; i++ ) {
						text += charset.charAt(Math.floor(Math.random() * charset.length));
					}
					
					return(text);		
				}
			
			};
			
			
			// Onready
			$(function() {
				$(".action-newgroup").click(function() {
					iniManager.newGroup();
				});
				
				$(".action-newpair").live("click",function() {
					var groupId = $(this).data("id");
					iniManager.newPair(groupId);
				});
			
				iniManager.html();
			}); // END onready