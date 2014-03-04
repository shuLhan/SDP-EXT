/*
 * Copyright 2014 - Mhd Sulhan
 * Authors:
 *   - mhd.sulhan (m.shulhan@gmail.com)
 */

function JxPahan10 ()
{
	this.id			= "Pahan_10";
	this.dir		= Jx.generateModDir (this.id);
	this.dirGol		= Jx.generateModDir ("Pahan_Golongan");
	this.dirTapi	= Jx.generateModDir (this.id +"_Tapi");
	this.dirWilayah	= Jx.generateModDir (this.id +"_.._Wilayah");
	this.dirPtd		= Jx.generateModDir (this.id +"_.._Penandatangan");

	this.store		= Ext.create ("Jx.Store",
	{
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
		,	"nm_pjbt_thn"
		]

	,	doFilterKejaksaan :function (cls, r, id)
		{
			var reg_gol		= r.get ("nmr_reg_gol");
			var torf		= false;

			if (true === cls.cbKejaksaanBdg.getValue ()) {
				if (reg_gol.search (new RegExp ("CMI", "i")) === -1) {
					return true;
				}
			}
			if (true === cls.cbKejaksaanCmi.getValue ()) {
				if (reg_gol.search (new RegExp ("CMI", "i")) !== -1) {
					return true;
				}
			}

			return torf;
		}

	,	doFilterAsalTahanan :function (cls, r, id)
		{
			var no_srt	= r.get ("nmr_srt_thn");
			var i		= 0;
			var asal	= "";
			if (true === cls.rbKepolisian.getValue ()) {
				asal = cls.rbKepolisian.getSubmitValue ();
				i = no_srt.search (new RegExp (asal, "i"));
				if (i !== -1) {
					return true;
				}
			}
			if (true === cls.rbKejati.getValue ()) {
				asal	= cls.rbKejati.getSubmitValue ();
				i		= no_srt.search (new RegExp (asal, "i"));
				if (i !== - 1) {
					return true;
				}
			}
			if (true === cls.rbPengadilan.getValue ()) {
				asal	= cls.rbPengadilan.getSubmitValue ();
				i = no_srt.search (new RegExp (asal, "i"));
				if (i !== - 1) {
					return true;
				}
			}

			return false;
		}

	,	doFilter	:function (cls)
		{
			cls.store.filterBy (function (r, id) {
				if (r.get ("id_reg") !== this.fGol.getValue ()) {
					return false;
				}

				var reg_gol	= r.get ("nmr_reg_gol");
				var torf	= false;

				torf = this.store.doFilterKejaksaan (this, r, id);

				if (false === torf) {
					return false;
				}

				if (true === this.cbNR.getValue ()) {
					if (reg_gol.search (new RegExp ("NR", "i")) !== -1) {
						return this.store.doFilterAsalTahanan (this, r, id);
					}
				} else {
					if (reg_gol.search (new RegExp ("NR", "i")) !== -1) {
						return false;
					}
				}
				if (true === this.cbTPK.getValue ()) {
					if (reg_gol.search (new RegExp ("TPK", "i")) !== -1) {
						return this.store.doFilterAsalTahanan (this, r, id);
					}
				} else {
					if (reg_gol.search (new RegExp ("TPK", "i")) !== -1) {
						return false;
					}
				}
				if (true === this.cbRESKRIM.getValue ()) {
					if (reg_gol.search (new RegExp ("NR|TPK", "i")) === -1) {
						return this.store.doFilterAsalTahanan (this, r, id);
					}
				} else {
					return false;
				}

				return torf;
			}
			, cls);
		}
	});

	this.fDate			= Ext.create ("Ext.form.field.Date",
	{
		fieldLabel		:"Tanggal Ekspirasi"
	,	labelWidth		:150
	,	name			:"date_expired"
	,	labelAlign		:"right"
	,	format			:"d/m/Y"
	,	submitFormat	:"Y-m-d"
	});

	this.storeGol	= Ext.create ("Jx.Store",
	{
		url			:this.dirGol
	,	autoLoad	:true
	,	singleApi	:false
	,	fields		:
		[
			"id"
		,	"text"
		]
	});

	this.fGol			= Ext.create ("Ext.form.field.ComboBox",
	{
		fieldLabel		:"Registrasi Golongan"
	,	labelWidth		:150
	,	labelAlign		:"right"
	,	store			:this.storeGol
	,	valueField		:"id"
	,	displayField	:"text"
	,	editable		:false
	});

	this.cbKejaksaanBdg	= Ext.create ("Ext.form.field.Checkbox",
	{
			name		:"kejaksaan"
		,	boxLabel	:"Bandung"
		,	inputValue	:"BDG"
		,	checked		:true
	});

	this.cbKejaksaanCmi	= Ext.create ("Ext.form.field.Checkbox",
	{
			name		:"kejaksaan"
		,	boxLabel	:"Kab. Bandung"
		,	inputValue	:"CMI"
		,	checked		:true
	});

	this.cgKejaksaan= Ext.create ("Ext.form.CheckboxGroup",
	{
		defaults	:
		{
			padding		:2
		,	width		:110
		}
	,	items		:
		[
			this.cbKejaksaanBdg
		,	this.cbKejaksaanCmi
		]
	});

	this.cbNR		= Ext.create ("Ext.form.field.Checkbox",
	{
		id			:"NR"
	,	boxLabel	:"Narkoba"
	,	name		:"reserse"
	,	inputValue	:"NR"
	,	checked		:true
	});

	this.cbTPK		= Ext.create ("Ext.form.field.Checkbox",
	{
		id			:"TPK"
	,	boxLabel	:"Tipikor"
	,	name		:"reserse"
	,	inputValue	:"TPK"
	,	checked		:true
	});

	this.cbRESKRIM	= Ext.create ("Ext.form.field.Checkbox",
	{
		id			:"RESKRIM"
	,	boxLabel	:"Reskrim"
	,	name		:"reserse"
	,	inputValue	:"RESKRIM"
	,	checked		:true
	});

	this.cgReserse	= Ext.create ("Ext.form.CheckboxGroup",
	{
		defaults	:
		{
			padding		:2
		,	width		:90
		}
	,	items		:
		[
			this.cbNR
		,	this.cbTPK
		,	this.cbRESKRIM
		]
	});

	this.rbKepolisian	= Ext.create ("Ext.form.field.Radio",
	{
		id				:"asal_polisi"
	,	name			:"asal_tahanan"
	,	boxLabel		:"Kepolisian"
	,	inputValue		:"SP.HAN"
	,	checked			:true
	});

	this.rbKejati		= Ext.create ("Ext.form.field.Radio",
	{
		id				:"asal_kejati"
	,	name			:"asal_tahanan"
	,	boxLabel		:"Kejati"
	,	inputValue		:"T-"
	,	checked			:false
	});

	this.rbPengadilan	= Ext.create ("Ext.form.field.Radio",
	{
		id				:"asal_pengadilan"
	,	name			:"asal_tahanan"
	,	boxLabel		:"Pengadilan"
	,	inputValue		:"Pen"
	,	checked			:false
	});

	this.rgAsalTahanan	= Ext.create ("Ext.form.RadioGroup",
	{
		layout		:"hbox"
	,	defaults	:
		{
			padding		:2
		,	width		:90
		}
	,	items		:
		[
			this.rbKepolisian
		,	this.rbKejati
		,	this.rbPengadilan
		]
	});

	this.bRefresh	= Ext.create ("Ext.button.Button",
	{
		text		:"Muat ulang"
	,	iconCls		:"refresh"
	,	flex		:0
	,	scope		:this
	,	handler		:function (b)
		{
			this.doLoad ();
		}
	});

	this.storeTapi	= Ext.create ("Jx.StorePaging",
	{
		url			:this.dirTapi
	,	singleApi	:false
	,	scope		:this
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
	});

	this.fTapi			= Ext.create ("Jx.ComboPaging",
	{
		name			:"nomor_induk"
	,	fieldLabel		:"Nama Lengkap"
	,	labelAlign		:"top"
	,	store			:this.storeTapi
	,	valueField		:"nomor_induk"
	,	displayField	:"nama_lengkap"
	,	flex			:1
	,	listConfig		:
		{
			loadingText	:"Memuat ..."
		,	emptyText	:"Data tidak ditemukan."
		,	getInnerTpl	:function ()
			{
				return	'<b>{nama_lengkap}</b><br/>'
						+'<ul>'
						+'<li>{nmr_reg_gol}<br/></li>'
						+'<li>{tgl_ekspirasi}</li>'
						+'<li>{nama_jaksa_utama}</li>'
						+'</ul>';
			}
		}
	});

	this.bAdd		= Ext.create ("Ext.button.Button",
	{
		iconCls		:"add"
	,	iconAlign	:"bottom"
	,	scope		:this
	,	handler		:function (b)
		{
			var r = this.fTapi.findRecordByValue (this.fTapi.getValue ());
			this.store.add (r);
		}
	});

	this.fPrintDate	= Ext.create ("Ext.form.field.Date",
	{
		fieldLabel		:"Tanggal Surat"
	,	name			:"print_date"
	,	labelWidth		:150
	,	labelAlign		:"right"
	,	flex			:1
	,	format			:"d/m/Y"
	,	value			:new Date ()
	});

	this.storeWilayah = Ext.create ("Jx.StorePaging",
	{
		url			:this.dirWilayah
	,	singleApi	:false
	,	autoLoad	:true
	,	scope		:this
	,	fields		:
		[
			"id"
		,	"nama"
		]
	});

	this.fWilayah1 = Ext.create ("Jx.ComboPaging",
	{
		name			:"wilayah"
	,	fieldLabel		:"Wilayah 1"
	,	labelAlign		:"right"
	,	labelWidth		:150
	,	store			:this.storeWilayah
	,	valueField		:"nama"
	,	displayField	:"nama"
	,	forceSelection	:false
	,	allowBlank		:false
	,	flex			:1
	});

	this.fWilayah2 = Ext.create ("Jx.ComboPaging",
	{
		name			:"wilayah"
	,	fieldLabel		:"Wilayah 2"
	,	labelAlign		:"right"
	,	labelWidth		:150
	,	store			:this.storeWilayah
	,	valueField		:"nama"
	,	displayField	:"nama"
	,	forceSelection	:false
	,	allowBlank		:false
	,	flex			:1
	});

	this.storePtd = Ext.create ("Jx.StorePaging",
	{
		url			:this.dirPtd
	,	singleApi	:false
	,	autoLoad	:true
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

	this.fPtd			= Ext.create ("Jx.ComboPaging",
	{
		name			:"penandatangan"
	,	fieldLabel		:"Penandatangan"
	,	labelAlign		:"top"
	,	store			:this.storePtd
	,	valueField		:"id"
	,	displayField	:"nama"
	,	forceSelection	:false
	,	flex			:1
	});

	this.bPrint		= Ext.create ("Ext.button.Button",
	{
		text		:"Cetak"
	,	iconCls		:"print"
	,	scope		:this
	,	handler		:function (b)
		{
			var gol		= this.fGol.getValue ();
			var form	= document.createElement('form');

			form.target	= "PAHAN_10_"+ gol;
			form.method	= "POST";
			form.action	= this.dir +"/print_"+ form.target + _g_ext;

			var postInput	= document.createElement ('input');
			postInput.type	= "hidden";
			postInput.name	= "data";
			postInput.value	= Ext.encode (Ext.pluck(this.store.data.items, 'data'));
			form.appendChild(postInput);

			var postInput	= document.createElement ('input');
			postInput.type	= "hidden";
			postInput.name	= "kejaksaan";
			postInput.value	= this.cgKejaksaan.getValue ().kejaksaan;
			form.appendChild(postInput);

			var postInput	= document.createElement ('input');
			postInput.type	= "hidden";
			postInput.name	= "reserse";
			postInput.value	= this.cgReserse.getValue ().reserse;
			form.appendChild(postInput);

			var postInput	= document.createElement ('input');
			postInput.type	= "hidden";
			postInput.name	= "asal_tahanan";
			postInput.value	= this.rgAsalTahanan.getValue ().asal_tahanan;
			form.appendChild(postInput);

			var postInput	= document.createElement ('input');
			postInput.type	= "hidden";
			postInput.name	= "print_date";
			postInput.value	= this.fPrintDate.getValue ();
			form.appendChild(postInput);

			var postInput	= document.createElement ('input');
			postInput.type	= "hidden";
			postInput.name	= "print_wilayah_1";
			postInput.value	= this.fWilayah1.getValue ();
			form.appendChild(postInput);

			var postInput	= document.createElement ('input');
			postInput.type	= "hidden";
			postInput.name	= "print_wilayah_2";
			postInput.value	= this.fWilayah2.getValue ();
			form.appendChild(postInput);

			var postInput	= document.createElement ('input');
			postInput.type	= "hidden";
			postInput.name	= "print_ptd";
			postInput.value	= Ext.encode (this.fPtd.findRecordByValue (this.fPtd.getValue ()).raw);
			form.appendChild(postInput);

			document.body.appendChild(form);

			var win = window.open ("", form.target);

			if (win) {
				form.submit();
			} else {
				Jx.msg.error ("You must allow popups for this map to work.");
			}
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
		,	locked		:true
		,	handler		:function (grid, rowidx, colidx, item, e, record)
			{
				grid.getStore ().remove (record);
			}
		},{
			header		:"No. Reg"
		,	dataIndex	:"nmr_reg_gol"
		,	width		:150
		,	locked		:true
		},{
			header		:"Nama Lengkap"
		,	dataIndex	:"nama_lengkap"
		,	width		:320
		,	locked		:true
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
		,	renderer	:function (v, md, r)
			{
				console.log (r.get("id_reg"));

				if (r.get ("id_reg") === "AII") {
					return r.get ("nm_pjbt_thn");
				} else {
					return r.get ("nama_jaksa_utama");
				}
			}
		}]
	,	dockedItems		:
		[{
			xtype		:"toolbar"
		,	dock		:"left"
		,	autoScroll	:true
		,	items		:
			[{
				xtype	:"fieldset"
			,	border	:false
			,	layout	:
				{
					type			:"vbox"
				,	pack			:"center"
				,	align			:"stretch"
				,	defaultMargins	:2
				,	flex			:1
				}
			,	items	:
				[
					this.fDate
				,	this.fGol
				,{
					xtype	:"fieldset"
				,	title	:"Asal Kejaksaan"
				,	items	:
					[
						this.cgKejaksaan
					]
				},{
					xtype	:"fieldset"
				,	title	:"Jenis Tahanan"
				,	items	:
					[
						this.cgReserse
					]
				},{
					xtype	:"fieldset"
				,	title	:"Tembusan / Asal Penahanan"
				,	items	:
					[
						this.rgAsalTahanan
					]
				}
				,	this.bRefresh
				]
			},{
				xtype	:"fieldset"
			,	title	:"Tambah manual"
			,	layout	:
				{
					type			:"hbox"
				,	pack			:"center"
				,	align			:"bottom"
				,	defaultMargins	:5
				,	flex			:1
				}
			,	items	:
				[
					this.fTapi
				,	this.bAdd
				]
			}
			,{
				xtype	:"fieldset"
			,	title	:"Konfigurasi Cetak"
			,	layout	:
				{
					type			:"vbox"
				,	pack			:"center"
				,	align			:"stretch"
				,	flex			:1
				}
			,	items	:
				[
					this.fPrintDate
				,	this.fWilayah1
				,	this.fWilayah2
				,	this.fPtd
				]
			},	"->"
			,	"-"
			,	this.bPrint
			]
		}]
	});

	this.storePtd.on ("load", function (store, r, success)
	{
		this.fPtd.select (r[1]);
	}
	, this);

	this.storeWilayah.on ("load", function (store, r, success)
	{
		this.fWilayah1.select (r[0]);
		this.fWilayah2.select (r[1]);
	}
	, this);

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
		if (fd.isValid ()) {
			this.doLoad ();
		}
	}
	, this);

	this.fGol.on ("change", function (cb, newv, oldv, e) {
		if (newv === "AI") {
			this.rbKepolisian.setValue (true);
			this.rbKepolisian.show ();
		} else {
			this.rbKepolisian.setValue (false);
			this.rbKejati.setValue (true);
			this.rbKepolisian.hide ();
		}
		this.store.doFilter (this);
	}
	, this);

	this.cgKejaksaan.on ("change", function (cg, newv, oldv, e)
	{
		this.store.doFilter (this);
	}
	, this);

	this.cgReserse.on ("change", function (rg, newv, oldv, e) {
		this.store.doFilter (this);
	}
	, this);

	this.rgAsalTahanan.on ("change"
	, function (rg, newv, oldv, e)
	{
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