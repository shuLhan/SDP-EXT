/*
 * Copyright 2014 - Mhd Sulhan
 * Authors:
 *   - mhd.sulhan (m.shulhan@gmail.com)
 */

function JxPahanWilayah ()
{
	this.id			= "Pahan_Wilayah";
	this.dir		= Jx.generateModDir (this.id);

	this.store		= Ext.create ("Jx.StorePaging",
	{
		url			:this.dir
	,	singleApi	:false
	,	fields		:
		[
			"id"
		,	"nama"
		]
	});

	this.panel	= Ext.create ("Jx.GridPaging.FormEditor",
	{
		id			:this.id
	,	panelConfig	:
		{
			title		:"Pahan > Referensi Wilayah"
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
			header		:"Nama Wilayah"
		,	dataIndex	:"nama"
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

var Pahan_Wilayah = new JxPahanWilayah();