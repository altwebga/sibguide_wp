<?php

// File generated from our OpenAPI spec

namespace Voxel\Vendor\CloudPayments;

/**
 * This object represents files hosted on CloudPayments's servers. You can upload
 * files with the <a href="https://cloudpayments.com/docs/api#create_file">create file</a> request
 * (for example, when uploading dispute evidence). CloudPayments also
 * creates files independently (for example, the results of a <a href="#scheduled_queries">Sigma scheduled
 * query</a>).
 *
 * Related guide: <a href="https://cloudpayments.com/docs/file-upload">File upload guide</a>
 *
 * @property string $id Unique identifier for the object.
 * @property string $object String representing the object's type. Objects of the same type share the same value.
 * @property int $created Time at which the object was created. Measured in seconds since the Unix epoch.
 * @property null|int $expires_at The file expires and isn't available at this time in epoch seconds.
 * @property null|string $filename The suitable name for saving the file to a filesystem.
 * @property null|\Voxel\Vendor\CloudPayments\Collection<\Voxel\Vendor\CloudPayments\FileLink> $links A list of <a href="https://cloudpayments.com/docs/api#file_links">file links</a> that point at this file.
 * @property string $purpose The <a href="https://cloudpayments.com/docs/file-upload#uploading-a-file">purpose</a> of the uploaded file.
 * @property int $size The size of the file object in bytes.
 * @property null|string $title A suitable title for the document.
 * @property null|string $type The returned file type (for example, <code>csv</code>, <code>pdf</code>, <code>jpg</code>, or <code>png</code>).
 * @property null|string $url Use your live secret API key to download the file from this URL.
 */
class File extends ApiResource
{
    const OBJECT_NAME = 'file';

    use ApiOperations\All;
    use ApiOperations\Retrieve;

    const PURPOSE_ACCOUNT_REQUIREMENT = 'account_requirement';
    const PURPOSE_ADDITIONAL_VERIFICATION = 'additional_verification';
    const PURPOSE_BUSINESS_ICON = 'business_icon';
    const PURPOSE_BUSINESS_LOGO = 'business_logo';
    const PURPOSE_CUSTOMER_SIGNATURE = 'customer_signature';
    const PURPOSE_DISPUTE_EVIDENCE = 'dispute_evidence';
    const PURPOSE_DOCUMENT_PROVIDER_IDENTITY_DOCUMENT = 'document_provider_identity_document';
    const PURPOSE_FINANCE_REPORT_RUN = 'finance_report_run';
    const PURPOSE_IDENTITY_DOCUMENT = 'identity_document';
    const PURPOSE_IDENTITY_DOCUMENT_DOWNLOADABLE = 'identity_document_downloadable';
    const PURPOSE_PCI_DOCUMENT = 'pci_document';
    const PURPOSE_SELFIE = 'selfie';
    const PURPOSE_SIGMA_SCHEDULED_QUERY = 'sigma_scheduled_query';
    const PURPOSE_TAX_DOCUMENT_USER_UPLOAD = 'tax_document_user_upload';
    const PURPOSE_TERMINAL_READER_SPLASHSCREEN = 'terminal_reader_splashscreen';

    // This resource can have two different object names. In latter API
    // versions, only `file` is used, but since cloudpayments-php may be used with
    // any API version, we need to support deserializing the older
    // `file_upload` object into the same class.
    const OBJECT_NAME_ALT = 'file_upload';

    use ApiOperations\Create {
        create as protected _create;
    }

    /**
     * @param null|array $params
     * @param null|array|string $opts
     *
     * @throws \Voxel\Vendor\CloudPayments\Exception\ApiErrorException if the request fails
     *
     * @return \Voxel\Vendor\CloudPayments\File the created file
     */
    public static function create($params = null, $opts = null)
    {
        $opts = \Voxel\Vendor\CloudPayments\Util\RequestOptions::parse($opts);
        if (null === $opts->apiBase) {
            $opts->apiBase = CloudPayments::$apiUploadBase;
        }
        // Manually flatten params, otherwise curl's multipart encoder will
        // choke on nested arrays.
        $flatParams = \array_column(\Voxel\Vendor\CloudPayments\Util\Util::flattenParams($params), 1, 0);

        return static::_create($flatParams, $opts);
    }
}
