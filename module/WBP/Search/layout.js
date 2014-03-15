/*
 * Copyright 2014 - Mhd Sulhan
 * Authors:
 *   - mhd.sulhan (m.shulhan@gmail.com)
 */

function JxWBPSearch ()
{
	this.id		= "WBP_Search";
	this.dir	= Jx.generateModDir (this.id);

	this.store	= Ext.create ("Jx.StorePaging", {
		url			:this.dir
	,	singleApi	:false
	,	fields		:
		[
			"nomor_induk"
		,	"nama_lengkap"
		,	"nmr_reg_gol"
		,	"status"
		,	"kamar"
		,	"foto_depan"
		,	"alamat"
		,	"tahun_hukuman"
		,	"bulan_hukuman"
		,	"hari_hukuman"
		,	"perkara"
		,	"tgl_ekspirasi"
		,	"tgl_sepertiga"
		,	"tgl_setengah"
		,	"tgl_duapertiga"
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
				this.store.proxy.extraParams.subaction = 1;
				this.store.reload ();
			} else {
				this.store.proxy.extraParams.subaction = 0;
				this.store.reload ();
			}
		}
	});

	this.wbp_info	= Ext.create ("Ext.grid.plugin.RowExpander", {
		pluginId	:"wbp_info"
	,	rowBodyTpl	:
		[
			"<table style='font-size:12px; border:0px solid; margin:0px; padding:0px; width:100%;'>"
		+	"<tr>"
			+"<th style='text-align:right; width:100px;'>Perkara</th><td>:</td><td>{perkara}</td>"
			+"<th style='text-align:right; width:100px;'>Lama Pidana</th><td>:</td><td>{tahun_hukuman} tahun {bulan_hukuman} bulan {hari_hukuman} hari</td>"
		+	"</tr>"
		+	"<tr>"
			+"<th style='text-align:right; width:100px;'>1/3 Pidana</th><td>:</td><td>{tgl_sepertiga}</td>"
			+"<th style='text-align:right; width:100px;'>2/3 Pidana</th><td>:</td><td>{tgl_duapertiga}</td>"
		+	"</tr>"
		+	"<tr>"
			+"<th style='text-align:right; width:100px;'>1/2 Pidana</th><td>:</td><td>{tgl_setengah}</td>"
			+"<th style='text-align:right; width:100px;'>Tgl. Ekspirasi</th><td>:</td><td>{tgl_ekspirasi}</td>"
		+	"</tr>"
		+	"<tr><th style='text-align:right; width:100px;'>Alamat</th><td>:</td><td colspan='4'>{alamat}</td></tr>"
		+	"</table>"
		]
	});

	this.panel			= Ext.create ("Jx.GridPaging", {
		id				:this.id
	,	title			:"Pencarian WBP"
	,	store			:this.store
	,	buttonBarList	:[]
	,	plugins			:
		[
			this.wbp_info
		]
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
			header		:"Kamar"
		,	dataIndex	:"kamar"
		,	width		:120
		},{
			header		:"Status"
		,	dataIndex	:"status"
		,	width		:240
		},{
			header		:"Foto Depan"
		,	xtype		:"actioncolumn"
		,	iconCls		:"photo"
		,	align		:"center"
		,	handler		:function (view, rowid, colidx, item, e, r, row)
			{
				var photo	= Ext.create ("Ext.window.Window",
				{
					title		:r.get("nama_lengkap")
				,	autoShow	:true
				,	modal		:true
				,	width		:600
				,	height		:400
				,	items		:
					[{
						xtype	:"image"
					,	src		:"/sdp/"+ r.get("foto_depan")
					,	width	:600
					,	height	:400
					}]
				});
			}
		}]
	});

	this.panel.searchField.setWidth (400);
	this.panel.buttonBar.add (this.fAktif);
	this.panel.buttonBar.add ("->");
	this.panel.buttonBar.add ("-");
	this.panel.buttonBar.add ("-");

	this.doRefresh = function (perm)
	{
		this.store.proxy.extraParams.subaction = 1;
	};
}

var WBP_Search = new JxWBPSearch ();