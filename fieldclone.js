
/*** FieldClone: Add 'duplicate' text fields to forms

(C)Scripterlative.com

Demo and further info: http://scripterlative.com?fieldclone

THESE INSTRUCTIONS MAY BE REMOVED, BUT NOT THE ABOVE TEXT.

Please notify any errors found.

Description
~~~~~~~~~~~
FieldClone is a Javascript utility that creates dimensional copies of specified form text fields.
New fields receive the same CSS class as the original field.
The new fields are inserted immediately after the original, preceded by zero or more <br> elements.
Options are available to select the derivation of the content of new fields, the application of
focus and text-selection, and the assignment of event handlers to provide "clear on focus, restore
on blur if blank" behaviour. A limit can be set on number of added fields.
New elements are automatically assigned a name based on that of the original field, plus a numeric
index. If the original field name already ends with a number, the index starts from that number
plus 1, otherwise at 2. This default behaviour can be disabled allowing all new fields to receive
the same name as the original, thus forming them into an array.
Methods are available to delete added fields.

Usage
~~~~~
FieldClone.add(field [, options]);
FieldClone.remove(field);
FieldClone.removeAll(field);
FieldClone.addClear(field);

Meaning of Parameters
~~~~~~~~~~~~~~~~~~~~~
field - A reference to a form field after whose position the new field will be added.
options - An optional string of parameters

Values for 'options' parameter
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
The 'options' parameter (if specified ) is passed as a single string containing one or more of the
options explained below, separated by commas or spaces. Parameters are not case-sensitive.

defaultValue - New fields are given the default value of the original field
firstValue   - New fields are given the current value of the original field
lastValue    - New fields are given the current value of the previous field
br           - Written as: br=n - the number of <br> characters inserted before the new field
limit        - Written as: limit=n - the maximum number additional fields
noindex     - Prevents a numeric index being appended to the name of the new field
focus        - Sets focus to the new field
select       - Selects the text content of the new field, if any.
clear        - Adds "clear on focus, restore on blur if blank" behaviour to the new field

Note: The 'clear' option cancels 'focus' and 'select'. The script can apply to original fields the
functionality provided by this option. This is achieved by calling the addClear() method directly.
Anywhere below the relevant form, insert:

<script type='text/javascript'>
 FieldClone.addClear(field);
</script>

where 'field' is a reference to the relevant text field.

Installation
~~~~~~~~~~~~
Save this text/file as 'fieldclone.js' and place it in a suitable folder.
In the <head> section of your HTML document, add the following:

<script type='text/javascript' src='fieldclone.js'></script>

Note: If 'fieldclone.js' resides in a different folder, include the relative path.

Configuration
~~~~~~~~~~~~~
With this script there's probably little to be gained from unobtrusive configuration, so examples
are given using inline event handlers.

Usage Examples
~~~~~~~~~~~~~~
These examples all use a 'button' type form input element to add text fields into the same form.
In this situation, form elements can be referenced directly by name.

- Add a text field after the field called 'userName' -

1) The field appears below the original and contains no text:

   <input type='button' value='Add new field' onclick="FieldClone.add(userName)">

2) The field appears adjacent to the original, contains the default text of the original and the
   text appears selected:

   <input type='button' value='Add new field' onclick='FieldClone.add(userName, "br=0, default, select")'>

3) New fields contain the text of the previous field and are named with the same name as the
   original, thus forming them into an array:

   <input type='button' value='Add new field' onclick='FieldClone.add(userName, "lastvalue, noindex")'>

4) New fields are given the focus, appear two lines below the previous and contain the current
   value of the first field. When the field is focused, the text clears; if the field is blurred
   with no content, its default text is restored:

   <input type='button' value='Add new field' onclick='FieldClone.add(userName, "focus, br=2, firstValue, clear")'>

5) This button removes the last field added:

   <input type='button' value='Remove last field' onclick='FieldClone.remove(userName)'>

6) This button removes all added fields:

   <input type='button' value='Remove all added fields' onclick='FieldClone.removeAll(userName)'>

Element References
~~~~~~~~~~~~~~~~~~
Within the scope of a form, as in all the above usage examples, elements of the form can be
referenced directly by their name attribute. However if the FieldClone functions are called from
code outside the scope of the form, then the form's elements are properly referenced thus:

 FieldClone.add(document.forms.myForm.myElement [, "options"]);

--------------

This code is free, however if you wish to reward the author and ensure the continued development of such scripts, you may make a donation at www.scripterlative.com.

*** DO NOT EDIT BELOW THIS LINE ***/

var FieldClone=
{
 add:function( original, options ) /*28432953637269707465726C61746976652E636F6D*/
 {
  var orig = original.length ? original[0] : original,
      prev = orig.lastInSeries || orig,
      isTA = ( orig.type == 'textarea' ),
      opts = options || "",
      hadIndex = /\d+/.test( prev.name ),
      hadIdIndex = /\d+/.test( prev.id ),
      
      index = /\bnoindex\b/i.test(opts) ? '' : hadIndex ? (Number(index)+1) : 2,
      
      eName = index ? ( hadIndex ? orig.name.replace(/\d+/, index) : orig.name + index ) : orig.name,
      
      //eId = index ? ( hadIdIndex ? orig.id.replace(/\d+/, index) : orig.id + index ) : orig.id 
      //Include above to increment ID indices
      brCount = ( brCount=opts.match(/\bbr\s*=\s*(\d+)/i) ) ? Number( brCount[1] ) : 1,
      limit= ( limit=opts.match(/\blimit\s*=\s*(\d+)/i) ) ? Number( limit[1] ) : 0,
      firstValue = /\bfirstvalue\b/i.test( opts ),
      lastValue = /\blastvalue\b/i.test( opts ) && !firstValue,
      defaultValue = /\bdefaultvalue\b/i.test( opts ) && !firstValue && !lastValue,
      focus = /\bfocus\b/i.test( opts ),
      select = /\bselect\b/i.test( opts ),
      clear = /\bclear\b/i.test( opts ) && !focus && !select,
      fieldValue = firstValue ? orig.value : lastValue ? prev.value : defaultValue ? orig.defaultValue : "",
      newElem = null,
      pos;
  
  orig.cloneCounter = (orig.cloneCounter==undefined) ?  0 : orig.cloneCounter;
          
  if(!limit || orig.cloneCounter < limit)
  {
    orig.cloneCounter++; 
     
    newElem = orig.cloneNode(false);
     
    newElem.name = eName;
    
    newElem.tabIndex = orig.tabIndex > 0 ? orig.tabIndex + orig.cloneCounter : 0; 
    
    // newElem.id = eId;
   
    orig.lastInSeries = newElem;
     
    for(var i = 0, pos = prev; i < brCount; i++)
     pos = pos.parentNode.insertBefore( document.createElement('br'), pos.nextSibling );
   
    pos.parentNode.insertBefore( newElem, pos.nextSibling );
   
    newElem.value = newElem.defaultValue = fieldValue;
   
    focus ? newElem.focus() : 0;
    clear ? this.addClear( newElem ) : 0;
    select ? newElem.select() : 0;
  }  

  return newElem;
 },

 remove:function(original)
 {
  var orig=original.length?original[0]:original;

  if(orig.lastInSeries && orig.lastInSeries !== orig)
  {
   while( orig.lastInSeries.previousSibling.nodeName == 'BR' )
    orig.lastInSeries.parentNode.removeChild(orig.lastInSeries.previousSibling);
   orig.lastInSeries=orig.lastInSeries.previousSibling;
   orig.lastInSeries.parentNode.removeChild(orig.lastInSeries.nextSibling);
   orig.cloneCounter--;
  }

  return orig.lastInSeries && orig.lastInSeries !== orig;
 },

 removeAll:function(orig)
 {
  while( this.remove(orig) )
  ;
 },

 addClear:function(elem)
 {
  elem.onfocus=function(){if(this.value==this.defaultValue)this.value='';}
  elem.onblur=function(){if(!/\S/.test(this.value))this.value=this.defaultValue;}
 }

}

