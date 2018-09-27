' WBT Manager browser window utilities
' Copyright (C) 1998-2001. Integrity eLearning
'	all rights reserved
'
' WBT Manager 1.55
'

'**********************
' restore and refresh parent window if child is closed
'**********************
Sub vbcheckchildclose()

	'refresh when child closed.
	Dim bClosed
	
On Error Resume Next' work around rpc errors

	bClosed = True
	bClosed = objWindowControl.hwnd.closed

	If bClosed Then
		'need vb "eval" function, to be done in future release.
		'eval( "window." & objWindowControl.strCallOnChildClose )
		window.focus
	Else
		window.setTimeout "vbcheckchildclose()",1000 ' check again in a second
	End If

End Sub

'*******************
' give focus back to child window if not closed
'*******************
Sub vbcheckchildfocus()

	'keep self in background.
	Dim bClosed
	
On Error Resume Next' work around rpc errors

	bClosed = True
	bClosed = objWindowControl.hwnd.closed

	If Not bClosed Then
		window.blur
		objWindowControl.hwnd.focus
	End If

End Sub

' old ie4 function.
Sub vbcheckchildwindow()

	'keep self in background,refresh when child closed.
	Dim bClosed
	
On Error Resume Next' work around rpc errors

	bClosed = True
	bClosed = objWindowControl.hwnd.closed

	If bClosed Then

		If Not IsNull( objWindowControl.strCallOnChildClose ) Then
			'need vb "eval" function, to be done in future release.
			'eval( "window." & objWindowControl.strCallOnChildClose )
		End If

		window.focus

	Else

		window.blur 'lose focus if we've got it
		window.setTimeout "vbcheckchildwindow()",1000 ' check again in a second

	End If

End Sub

