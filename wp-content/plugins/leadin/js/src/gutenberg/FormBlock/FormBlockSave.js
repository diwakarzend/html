import React, { Fragment } from 'react';
import { formsScript, formsScriptPayload } from '../../constants/leadinConfig';

export default function FormSaveBlock({ attributes }) {
  const { portalId, formId } = attributes;
  const divUuid = `${new Date().getTime()}-${Math.floor(
    Math.random() * 1e10 + 1
  )}`;
  if (portalId && formId) {
    return (
      <Fragment>
        <script>
          {`
            hbsptReady({
              portalId: '${portalId}',
              formId: '${formId}',
              target: '#hbspt-form-${divUuid}',
              ${formsScriptPayload}
            });
          `}
        </script>
        <div id={`hbspt-form-${divUuid}`} className="hbspt-form" />
        <script
          charset="utf-8"
          type="text/javascript"
          src={formsScript}
          defer="true"
          onLoad="window.hbsptReady()"
        />
      </Fragment>
    );
  }
  return null;
}
