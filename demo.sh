if [ ! -f apikey ]; then
  echo "AUTH check: apikey file is missing!, created it. Please fill in your apikey and try again"
  touch apikey
  exit 1
else
  if [ ! -s apikey ]; then
  echo "AUTH check: apikey file is empty. Please fill in your apikey and try again"
else
  echo "AUTH check: : got your apikey and i will go on."
  key='cat apikey'
  fi
fi

echo "your apikey == "$key""
