(function($) {
	$(document).ready(function(){
		var stanItems = [
             { id: 1, text: 'Bardzo Dobry' },
             { id: 2, text: 'Dobry' },
             { id: 3, text: 'Remont do 5tyś.' },
             { id: 4, text: 'Remont do 10tyś.' },
             { id: 5, text: 'Całkowity remont' }
         ];
		
		$('#grid').w2grid({
			name : 'listaMieszkan',
			header : 'Wybrane mieszkania',
			show : {
				header : true,
				toolbar : true,
				toolbarDelete : true,
				footer : true,
				selectColumn : true,
				expandColumn : true,
				toolbarAdd : true,
				toolbarDelete : true,
				toolbarSave : true,
				toolbarEdit : true
			},
			recordHeight: 35,
			columns : [ {
				"field" : "recid",
				"caption" : "ID",
				"size" : "35px",
				"searchable" : "int",
				"sortable" : true,
				"resizable" : true
			}, {
				"field" : "cena",
				"caption" : "Cena",
				"editable": { 
					"type": 'money'
				}, 
				"render": 'money',
				"size" : "100px",
				"searchable" : "int",
				"sortable" : true,
				"resizable" : true
			}, {
				"field" : "adres",
				"caption" : "Adres",
				"size" : "300px",
				"editable": { 
					"type": 'alphaNumeric'
				}, 
				"searchable" : "text",
				"sortable" : true,
				"resizable" : true
			}, {
				"field" : "pokoje",
				"caption" : "Pokoje",
				"size" : "60px",
				"searchable" : "text",
				"sortable" : true,
				"resizable" : true
			}, {
				"field" : "powierzchnia",
				"caption" : "Powierzchnia",
				"size" : "100px",
				"searchable" : "text",
				"sortable" : true,
				"resizable" : true
			}, {
				"field" : "rokbudowy",
				"caption" : "Rok budowy",
				"size" : "100px",
				"editable": { 
					"type": 'alphaNumeric'
				}, 
				"searchable" : "text",
				"sortable" : true,
				"resizable" : true
			}, {
				"field" : "sdate",
				"caption" : "Data dodania",
				"size" : "120px",
				"editable": { 
					"type": 'date' 
				},
				"searchable" : "text",
				"sortable" : true,
				"resizable" : true
			},{
				"field" : "stan",
				"caption" : "Stan",
				"size" : "120px",
				"editable": { 
					"type": 'list', 
					"items": stanItems 
				},
				"render": function (record, index, col_index) {
                    var html = this.getCellValue(index, col_index);
                    return html.text || '';
                }
			} ],
			onClick : function(event) {
				w2ui['grid2'].clear();
				var record = this.get(event.recid);
				w2ui['grid2'].add([ {
					recid : 0,
					name : 'ID:',
					value : record.recid
				}, {
					recid : 1,
					name : 'Cena:',
					value : record.cena
				}, {
					recid : 2,
					name : 'Adres:',
					value : record.adres
				}, {
					recid : 3,
					name : 'Pokoje:',
					value : record.pokoje
				}, {
					recid : 4,
					name : 'Powierzchnia:',
					value : record.powierzchnia
				}, {
					recid : 5,
					name : 'Rok budowy:',
					value : record.rokbudowy
				}, {
					recid : 6,
					name : 'Stan:',
					value : record.stan
				} ]);
				this.refresh();
			}
		}); // end $('#grid').w2grid(
		
		w2ui['listaMieszkan'].load('/js/dane.json');
		$('#grid2')
				.w2grid(
						{
							header : 'Szczegóły mieszkania',
							show : {
								header : true,
								columnHeaders : false
							},
							name : 'grid2',
							columns : [
									{
										field : 'name',
										caption : 'Name',
										size : '100px',
										style : 'background-color: #efefef; border-bottom: 1px solid white; padding-right: 5px;',
										attr : "align=right"
									}, {
										field : 'value',
										caption : 'Value',
										size : '100%'
									} ]
						});
	});
})(jQuery);