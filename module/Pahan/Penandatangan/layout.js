/*
 * Copyright 2014 - Mhd Sulhan
 * Authors:
 *   - mhd.sulhan (m.shulhan@gmail.com)
 */

function JxPahanPenandatangan ()
{
	this.id		= "Pahan_Penandatangan";
	this.dir	= Jx.generateModDir (this.id);

	this.store	= Ext.create ("Jx.StorePaging",
	{
		url			:this.dir
	,	singleApi	:false
	,	scope		:this
	,	fields		:
		[
			"id"
		,	"kepala_text"
		,	"jabatan"
		,	"nama"
		,	"nip"
		]
	});

	this.panel	= Ext.create ("Jx.GridPaging.FormEditor",
	{
		id			:this.id
	,	panelConfig	:
		{
			title		:"Pahan > Referensi Penandatangan"
		,	closable	:false
		}
	,	formConfig	:
		{
			syncUseStore	:false
		}
	,	store		:this.store
	,	columns		:
		[{
			header		:"ID"
		,	dataIndex	:"id"
		,	hidden		:true
		,	editor		:
			{
				xtype		:"textfield"
			,	hidden		:true
			}
		},{
			header		:"Kepala Teks"
		,	dataIndex	:"kepala_text"
		,	flex		:1
		,	editor		:
			{
				xtype		:"textfield"
			,	allowBlank	:true
			}
		},{
			header		:"Jabatan"
		,	dataIndex	:"jabatan"
		,	flex		:1
		,	editor		:
			{
				xtype		:"textfield"
			,	allowBlank	:true
			}
		},{
			header		:"Nama"
		,	dataIndex	:"nama"
		,	flex		:1
		,	editor		:
			{
				xtype		:"textfield"
			,	allowBlank	:false
			}
		},{
			header		:"NIP"
		,	dataIndex	:"nip"
		,	flex		:1
		,	editor		:
			{
				xtype		:"textfield"
			,	allowBlank	:false
			}
		}]
	});

	this.doRefresh	= function (perm)
	{
		this.panel.doRefresh (perm);
	};
}

var Pahan_Penandatangan = new JxPahanPenandatangan ();