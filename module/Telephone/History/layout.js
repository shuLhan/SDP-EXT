/* 
 * Copyright 2014 - Mhd Sulhan
 * Authors:
 *   - mhd.sulhan (m.shulhan@gmail.com)
 */

function JxTelephoneHistory ()
{
	this.id		= "Telephone_History";
	this.dir	= Jx.generateModDir (this.id);

	this.store	= Ext.create ("Jx.StorePaging", {
		url			:this.dir
	,	singleApi	:false
	,	fields		:
		[
			"nomor_induk"
		,	"nama_lengkap"
		,	"sn"
		,	"pin"
		,	"status"
		,	"update_date"
		]
	});

	this.panel			= Ext.create ("Jx.GridPaging", {
		id				:this.id
	,	store			:this.store
	,	buttonBarList	:[]
	,	columns			:
		[{
			header		:"Nomor Induk"
		,	dataIndex	:"nomor_induk"
		,	width		:140
		},{
			header		:"Nama Lengkap"
		,	dataIndex	:"nama_lengkap"
		,	flex		:1
		},{
			header		:"Serial Number"
		,	dataIndex	:"sn"
		,	width		:120
		},{
			header		:"PIN"
		,	dataIndex	:"pin"
		,	width		:80
		},{
			header		:"Status"
		,	dataIndex	:"status"
		,	width		:80
		,	renderer	:function (v)
			{
				if (v == 1) {
					return "Aktif";
				}
				return "Non-aktif";
			}
		},{
			header		:"Tanggal Update"
		,	dataIndex	:"update_date"
		,	width		:160
		}]
	});

	this.panel.searchField.setWidth (400);
	this.panel.buttonBar.add ("->");
	this.panel.buttonBar.add ("-");
	this.panel.buttonBar.add ("-");

	this.doRefresh = function (perm)
	{
		
	}
}

var Telephone_History = new JxTelephoneHistory ();