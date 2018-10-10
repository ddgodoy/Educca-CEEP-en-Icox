var VarInterface={Init:function(){this.Types.Add("Direct",function(sParam){return sParam;})
this.Types.Add("Custom",function(fParam){return fParam();})
document.body.isVarSupported=function(sVarName){return VarInterface.Variables[sVarName]!==undefined}
document.body.getVarValue=function(sVarName){return VarInterface.Get(sVarName)}},Variables:{},Types:{Add:function(sType,fImplementation){this[sType]=fImplementation;}},Add:function(sVar,sType,vParam){this.Variables[sVar]={Param:vParam,Type:sType}},Get:function(sVar){return this.Types[this.Variables[sVar].Type](this.Variables[sVar].Param)}}