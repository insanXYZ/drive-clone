function convertByte(bytes) {
  if (bytes < 1024) {
    return bytes + ' B';
  } else if (bytes < 1048576) { // 1024 KB
    const kb = (bytes / 1024).toFixed(2);
    return kb + ' KB';
  } else {
    const mb = (bytes / 1048576).toFixed(2);
    return mb + ' MB';
  }
}

export default convertByte;