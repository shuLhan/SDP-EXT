/* 
 * Copyright 2014 - Mhd Sulhan
 * Authors:
 *   - mhd.sulhan (m.shulhan@gmail.com)
 */

function JxWBPSterek ()
{
	this.id		= "WBP_Sterek";
	this.dir	= Jx.generateModDir (this.id);

	this.storeSearch	= Ext.create ("Jx.StorePaging", {
		url				:this.dir
	,	singleApi		:false
	,	fields			:
		[
			"nomor_induk"
		,	"nama_lengkap"
		,	"nmr_reg_gol"
		,	"foto_depan"
		,	"tahun_hukuman"
		,	"bulan_hukuman"
		,	"hari_hukuman"
		,	"perkara"
		,	"tgl_ekspirasi"
		,	"kamar"
		]
	});

	this.storeSterek	= Ext.create ("Jx.Store", {
		url				:this.dir
	,	singleApi		:false
	,	fields			:
		[
			"nomor_induk"
		,	"foto_depan"
		,	"nama_lengkap"
		,	"nmr_reg_gol"
		,	"tahun_hukuman"
		,	"bulan_hukuman"
		,	"hari_hukuman"
		,	"perkara"
		,	"tgl_ekspirasi"
		,	"kamar"
		]
	});
	
	this.panel_search_re = Ext.create ("Ext.grid.plugin.RowExpander", {
		pluginId		:"panel_search_rowexpander"
	,	rowBodyTpl		:
		[
			"<table align='left' style='font-size:10px; border:1px solid;'>"
		+	"<td rowspan='9'><img src='"+ this.dir +"/image_crop.php?image_path=/sdp/{foto_depan}' width='auto' height='100'/></td>"
		+	"<tr><th align='left'>NO. REG</th><td>:</td><td>{nmr_reg_gol}</td><tr>"
		+	"<tr><th align='left'>PUTUSAN</th><td>:</td><td>{tahun_hukuman} THN {bulan_hukuman} BLN {hari_hukuman} HR</td></tr>"
		+	"<tr><th align='left'>PERKARA</th><td>:</td><td>{perkara}</td></tr>"
		+	"<tr><th align='left'>EKSPIRASI</th><td>:</td><td>{tgl_ekspirasi}</td></tr>"
		+	"<tr><th align='left'>KAMAR</th><td>:</td><td>{kamar}</td></tr>"
		+	"</table>"
		]		
	});

	this.fAktif			= Ext.create ("Ext.form.field.Checkbox", {
		checked			:true
	,	inputValue		:1
	,	uncheckedValue	:0
	,	boxLabel		:"Aktif"
	,	scope			:this
	,	handler			:function (cb, v)
		{
			if (v) {
				this.storeSearch.proxy.extraParams.subaction = 1;
				this.storeSearch.reload ();
			} else {
				this.storeSearch.proxy.extraParams.subaction = 0;
				this.storeSearch.reload ();
			}
		}
	});

	this.panel_search	= Ext.create ("Jx.GridPaging", {
		id				:this.id +'_Search'
	,	title			:"Pencarian WBP"
	,	store			:this.storeSearch
	,	region			:"center"
	,	buttonBarList	:[]
	,	columns			:
		[{
			header		:"Data WBP"
		,	dataIndex	:"nama_lengkap"
		,	flex		:1
		},{
			xtype		:"actioncolumn"
		,	iconCls		:"add"
		,	width		:40
		,	scope		:this
		,	handler		:function (view, rowidx, colidx, item, e, record)
			{
				this.origScope.storeSearch.remove (record);
				this.origScope.storeSterek.add (record);
			}
		}]
	,	plugins			:
		[
			this.panel_search_re
		]
	,	viewConfig		:
		{
			plugins			:
			[{
				ptype			:"gridviewdragdrop"
			,	pluginId		:"panel_search_dnd"
			,	dragGroup		:this.id +"_Search"
			,	dropGroup		:this.id +"_Sterek"
			}]
		,	listeners		:
			{
				drop: function(node, data, dropRec, dropPosition)
				{
					var dropOn = dropRec
						? ' ' + dropPosition + ' ' + dropRec.get('nama_lengkap')
						: ' on empty view';
				}
			}
		}
	});

	this.panel_sterek	= Ext.create ("Ext.grid.Panel", {
		id				:this.id +'_Sterek'
	,	title			:"WBP Cetak Sterek"
	,	titleAlign		:"center"
	,	store			:this.storeSterek
	,	width			:"50%"
	,	region			:"east"
	,	split			:true
	,	tbar			:
		{
			items			:
			["->"
			,{
				text			:"Cetak"
			,	scope			:this
			,	handler			:function (b)
				{
					var form = document.createElement('form');

					form.target	= "sterek";
					form.method	= "POST";
					form.action	= this.dir +"/print.php";

					var postInput = document.createElement ('input');
					postInput.type = "hidden";
					postInput.name = "data";
					postInput.value = Ext.encode (Ext.pluck(this.storeSterek.data.items, 'data'));

					form.appendChild(postInput);
					document.body.appendChild(form);
					
					sterek = window.open ("", "sterek");
					
					if (sterek) {
						form.submit();
					} else {
						Jx.msg.error ("You must allow popups for this map to work.");
					}
				}
			}
			,"->",
			{
				text	:"Hapus semua"
			,	scope	:this
			,	handler	:function (b)
				{
					this.storeSterek.removeAll ();
				}
			}]
		}
	,	columns			:
		[{
			header		:"No. Registrasi"
		,	dataIndex	:"nmr_reg_gol"
		,	width		:160
		},{
			header		:"Nama Lengkap"
		,	dataIndex	:"nama_lengkap"
		,	flex		:1
		},{
			xtype		:"actioncolumn"
		,	iconCls		:"delete"
		,	width		:40
		,	handler		:function (view, rowidx, colidx, item)
			{
				view.getStore ().removeAt (rowidx);
			}
		}]
	,	viewConfig		:
		{
			plugins			:
			{
				ptype			: 'gridviewdragdrop'
			,	dragGroup		: this.id +"_Sterek"
			,	dropGroup		: this.id +"_Search"
			}
		,	listeners		:
			{
				drop: function(node, data, dropRec, dropPosition)
				{
					var dropOn = dropRec
						? ' ' + dropPosition + ' ' + dropRec.get('nama_lengkap')
						: ' on empty view';
				}
			}
		}
	});
	
	this.panel		= Ext.create ("Ext.form.Panel", {
		id			:this.id
	,	title		:"WBP Sterek"
	,	titleAlign	:"center"
	,	layout		:"border"
	,	items		:
		[
			this.panel_search
		,	this.panel_sterek
		]
	});

	this.panel_search.searchField.setWidth (400);
	this.panel_search.buttonBar.add (this.fAktif);
	this.panel_search.buttonBar.add ("->");
	this.panel_search.buttonBar.add ("-");
	this.panel_search.buttonBar.add ("-");

	this.storeSearch.on ("load", function (store, records, success, e)
	{
		if (! success) {
			return;
		}
		
		for (var i = 0; i < records.length; i++)
		{
			this.panel_search_re.toggleRow (i, records[i]);
		}
	}, this);

	this.doRefresh = function (perm)
	{
		this.storeSearch.proxy.extraParams.subaction = 1;
	};
}

var WBP_Sterek = new JxWBPSterek ();