<<<<<<< HEAD
﻿/*
 * Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

(function()
{
	function limereplacementfieldsDialog( editor, isEdit )
	{
		var lang = editor.lang.limereplacementfields,
			generalLabel = editor.lang.common.generalTab;
		return {
			title : lang.title,
			minWidth : 300,
			minHeight : 80,
			contents :
			[
				{
					id : 'info',
					label : generalLabel,
					title : generalLabel,
					elements :
					[
						{
							id : 'text',
							type : 'html',
							label : lang.title,
						    html : CKEDITOR.ajax.load(editor.config.LimeReplacementFieldsPath + '/fieldtype/' +
						    	editor.config.LimeReplacementFieldsType + '/action/' +
						    	editor.config.LimeReplacementFieldsAction + '/surveyid/' +
						    	editor.config.LimeReplacementFieldsSID + '/gid/' +
						    	editor.config.LimeReplacementFieldsGID + '/qid/' +
						    	editor.config.LimeReplacementFieldsQID
),
							setup : function( element )
							{
								if ( isEdit )
								    $('#cquestions').val( element.getText().slice( 1, -1 ) );
							},
							commit : function( element )
							{
								var text = '{' + $('#cquestions').val() + '}';
								// The limereplacementfields must be recreated.
								CKEDITOR.plugins.limereplacementfields.createlimereplacementfields( editor, element, text );
							}
						}
					]
				}
			],
			onShow : function()
			{
				if ( isEdit )
					this._element = CKEDITOR.plugins.limereplacementfields.getSelectedPlaceHoder( editor );

				this.setupContent( this._element );
			},
			onOk : function()
			{
				this.commitContent( this._element );
				delete this._element;
			}
		};
	}

	CKEDITOR.dialog.add( 'createlimereplacementfields', function( editor )
		{
			return limereplacementfieldsDialog( editor );
		});
	CKEDITOR.dialog.add( 'editlimereplacementfields', function( editor )
		{
			return limereplacementfieldsDialog( editor, 1 );
		});
} )();
=======
﻿/*
 * Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

(function()
{
	function limereplacementfieldsDialog( editor, isEdit )
	{
		var lang = editor.lang.limereplacementfields,
			generalLabel = editor.lang.common.generalTab;
		return {
			title : lang.title,
			minWidth : 300,
			minHeight : 80,
			contents :
			[
				{
					id : 'info',
					label : generalLabel,
					title : generalLabel,
					elements :
					[
						{
							id : 'text',
							type : 'html',
							label : lang.title,
						    html : CKEDITOR.ajax.load(editor.config.LimeReplacementFieldsPath + '/fieldtype/' +
						    	editor.config.LimeReplacementFieldsType + '/action/' +
						    	editor.config.LimeReplacementFieldsAction + '/surveyid/' +
						    	editor.config.LimeReplacementFieldsSID + '/gid/' +
						    	editor.config.LimeReplacementFieldsGID + '/qid/' +
						    	editor.config.LimeReplacementFieldsQID
),
							setup : function( element )
							{
								if ( isEdit )
								    $('#cquestions').val( element.getText().slice( 1, -1 ) );
							},
							commit : function( element )
							{
								var text = '{' + $('#cquestions').val() + '}';
								// The limereplacementfields must be recreated.
								CKEDITOR.plugins.limereplacementfields.createlimereplacementfields( editor, element, text );
							}
						}
					]
				}
			],
			onShow : function()
			{
				if ( isEdit )
					this._element = CKEDITOR.plugins.limereplacementfields.getSelectedPlaceHoder( editor );

				this.setupContent( this._element );
			},
			onOk : function()
			{
				this.commitContent( this._element );
				delete this._element;
			}
		};
	}

	CKEDITOR.dialog.add( 'createlimereplacementfields', function( editor )
		{
			return limereplacementfieldsDialog( editor );
		});
	CKEDITOR.dialog.add( 'editlimereplacementfields', function( editor )
		{
			return limereplacementfieldsDialog( editor, 1 );
		});
} )();
>>>>>>> refs/remotes/origin/master
