const isAndroid = () => !!navigator.userAgent.match(/android/i);

const isIphone = () => !!navigator.userAgent.match(/iphone/i);

const isIpad = () => !!navigator.userAgent.match(/ipad/i);


const isMobile = () => {
  if (isAndroid()) return true;
  else if (isIphone()) return true;
  else if (isIpad()) return true;
  return false;
};


