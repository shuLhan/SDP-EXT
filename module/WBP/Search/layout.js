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

	this.panel			= Ext.create ("Jx.GridPaging", {
		id				:this.id
	,	title			:"Pencarian WBP"
	,	store			:this.store
	,	buttonBarList	:[]
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