/*
 * Copyright 2014 - Mhd Sulhan
 * Authors:
 *   - mhd.sulhan (m.shulhan@gmail.com)
 */

function JxPahan10 ()
{
	this.id		= "Pahan_10";
	this.dir	= Jx.generateModDir (this.id);
	this.dirGol	= Jx.generateModDir ("Pahan_Golongan");

	this.store		= Ext.create ("Jx.Store", {
		url			:this.dir
	,	autoLoad	:false
	,	singleApi	:false
	,	extraParams	:
		{
			id_reg		:""
		}
	,	fields		:
		[
			"nomor_induk"
		,	"id_reg"
		,	"nmr_reg_gol"
		,	"nama_lengkap"
		,	"alamat"
		,	"tgl_srt_thn"
		,	"nmr_srt_thn"
		,	"tgl_awal_tahan_golongan"
		,	"tgl_ekspirasi"
		,	"nama_jaksa_utama"
		]
	,	doFilter	:function (cls)
		{
			cls.store.filterBy (function (r, id) {
				var reg_gol	= r.get ("nmr_reg_gol");
				var reserse = this.rgReserse.getValue ().reserse;

				if (r.get ("id_reg") === this.fGol.getValue ()) {
					if (reserse === "NR") {
						if (reg_gol.search (new RegExp ("NR", "i")) !== -1) {
							return true;
						}
						return false;
					} else if (reserse === "TPK") {
						if (reg_gol.search (new RegExp ("TPK", "i")) !== -1) {
							return true;
						}
						return false;
					} else {
						if (reg_gol.search (new RegExp ("NR|TPK", "i")) !== -1) {
							return false;
						}
						return true;
					}
				}
				return false;
			}
			, cls);
		}
	});

	this.storeGol	= Ext.create ("Jx.Store", {
		url			:this.dirGol
	,	autoLoad	:true
	,	singleApi	:false
	,	fields		:
		[
			"id"
		,	"text"
		]
	});

	this.fDate			= Ext.create ("Ext.form.field.Date", {
		fieldLabel		:"Tanggal Ekspirasi"
	,	name			:"date_expired"
	,	width			:80
	,	labelWidth		:140
	,	labelAlign		:"top"
	,	format			:"d/m/Y"
	,	submitFormat	:"Y-m-d"
	});

	this.fGol			= Ext.create ("Ext.form.field.ComboBox", {
		fieldLabel		:"Registrasi Golongan"
	,	labelAlign		:"top"
	,	labelWidth		:140
	,	store			:this.storeGol
	,	valueField		:"id"
	,	displayField	:"text"
	,	editable		:false
	,	selectOnFocus	:true
	});

	this.rgReserse	= Ext.create ("Ext.form.RadioGroup", {
		border		:1
	,	style		:
		{
			borderColor	:'silver'
		,	borderStyle	:'solid'
		}
	,	defaults	:
		{
			name		:"reserse"
		,	padding		:2
		,	width		:80
		}
	,	items		:
		[{
			boxLabel	:"Reskrim"
		,	inputValue	:"RESKRIM"
		,	checked		:true
		},{
			boxLabel	:"Narkoba"
		,	inputValue	:"NR"
		},{
			boxLabel	:"Tipikor"
		,	inputValue	:"TPK"
		}]
	});

	this.bRefresh	= Ext.create ("Ext.button.Button", {
		text		:"Muat ulang"
	,	iconCls		:"refresh"
	,	scope		:this
	,	handler		:function (b)
		{
			this.doLoad ();
		}
	});
	
	this.bPrint		= Ext.create ("Ext.button.Button", {
		text		:"Cetak"
	,	iconCls		:"print"
	,	scope		:this
	,	handler		:function (b)
		{
			
		}
	});	

	this.panel	= Ext.create ("Ext.grid.Panel", {
		id				:this.id
	,	title			:"Pahan 10"
	,	titleAlign		:"center"
	,	store			:this.store
	,	columns			:
		[{
			xtype		:"actioncolumn"
		,	align		:"center"
		,	iconCls		:"delete"
		,	width		:40
		,	handler		:function (grid, rowidx, colidx, item, e, record)
			{
				grid.getStore ().remove (record);
			}
		},{
			header		:"No. Reg"
		,	dataIndex	:"nmr_reg_gol"
		,	width		:150
		},{
			header		:"Nama Lengkap"
		,	dataIndex	:"nama_lengkap"
		,	width		:320
		},{
			header		:"Tgl. Penahanan"
		,	dataIndex	:"tgl_srt_thn"
		,	align		:"center"
		,	width		:120
		},{
			header		:"No. Surat Penahanan"
		,	dataIndex	:"nmr_srt_thn"
		,	width		:220
		},{
			header		:"Tgl. Mulai Ditahan"
		,	dataIndex	:"tgl_awal_tahan_golongan"
		,	align		:"center"
		,	width		:140
		},{
			header		:"JPU"
		,	dataIndex	:"nama_jaksa_utama"
		,	width		:160
		}]
	,	dockedItems		:
		[{
			xtype		:"toolbar"
		,	dock		:"left"
		,	items		:
			[
				this.fDate
			,	this.fGol
			,	this.rgReserse
			,	"-"
			,	this.bRefresh
			,	"->"
			,	"-"
			,	this.bPrint			
			]
		}]
	});

	this.storeGol.on ("load", function (store, r, success)
	{
		this.fGol.setValue (store.getAt (0));
		this.doLoad ();
	}, this);

	this.store.on ("load", function (store, r, success)
	{
		this.store.doFilter (this);
	}
	, this);
	
	this.fDate.on ("change", function (fd, newv, oldv, e) {
		this.doLoad ();
	}
	, this);

	this.fGol.on ("change", function (cb, newv, oldv, e) {
		this.store.doFilter (this);
	}
	, this);
	
	this.rgReserse.on ("change", function (rg, newv, oldv, e) {
		this.store.doFilter (this);
	}
	, this);
	
	this.doLoad	= function ()
	{
		this.store.proxy.extraParams.query = this.fDate.getSubmitValue ();
		this.store.load ();
	};

	this.doRefresh = function (perm)
	{
		var d = new Date ();
		d.setDate (d.getDate() + 10);
		this.fDate.setValue (d);
		this.doLoad ();
	};
}

var Pahan_10 = new JxPahan10 ();