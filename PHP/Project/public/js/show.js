function show(obj, id)
{
  var o=document.getElementById(id).value;
  if( o.value == "我要排MIC" )
  {
    obj.innerHTML='取消排MIC';
  }
  else
  {
    obj.innerHTML='我要排MIC';
  }
}