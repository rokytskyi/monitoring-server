#!/usr/bin/env bash

cmd="/usr/local/bin/siege"
args="-v"

if [ -n "${CONCURRENT}" ];then
  args="${args} -c ${CONCURRENT}"
fi

if [ -n "${REPS}" ];then
  args="${args} -r ${REPS}"
fi

if [ -n "${TIME}" ];then
  args="${args} -t ${TIME}"
fi

if [ -n "${HEADER}" ];then
  args="${args} -H ${HEADER}"
fi

if [ -n "${URL}" ];then
  cmd="${cmd} ${args} ${URL}"
elif [ -n "${FILE}" ];then
  cmd="${cmd} ${args} -f ${FILE}"
fi

echo ${cmd}
eval ${cmd}