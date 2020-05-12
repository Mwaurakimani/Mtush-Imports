<?php
    class FileInfoTool {

        private $file;
        private $file_info;

        /**
        * @param str => $ file = path to the file (ABSOLUTE OR RELATIVE)
        */
        public function get_file(string $file){
            clearstatcache();
            $file = str_replace(array('/', '\\'), array(DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR), $file);
            if(!is_file($file) && !is_executable($file) && !is_readable($file)){
                throw new \Exception('The reported file was not found!');
            }
            $this->file = $file;
            $this->set_file_info($this->file);
            return $this;
        }

    /**
     * @param str => $index = if an index is informed, specific file information is returned
     */
        public function get_info($index = ''){
            if($this->get_file_is_called()){
                if($index === ''){
                    return $this->file_info;
                }
                if($index != ''){
                    if(!array_key_exists($index, $this->file_info)){
                        throw new \Exception('The requested information was not found!');                   
                    }
                    return $this->file_info;
                }
            }
        }

    /**
     * @todo checks if the get_file () method was used to inform the file path
     */
        private function get_file_is_called(){
            if(!$this->file){
                throw new \Exception('No files were provided for analysis. Use the get_file () method for this!');
                return false;
            }
            return true;
        }

        /**
        * @todo preencher a array com as infos do arquivo
        */
        private function set_file_info(){
            $this->file_info = array();
            $pathinfo = pathinfo($this->file);
            $stat = stat($this->file);
            $this->file_info['realpath'] = realpath($this->file);
            $this->file_info['dirname'] = $pathinfo['dirname'];
            $this->file_info['basename'] = $pathinfo['basename'];
            $this->file_info['filename'] = $pathinfo['filename'];
            $this->file_info['extension'] = $pathinfo['extension'];
            $this->file_info['mime'] = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $this->file);
            $this->file_info['encoding'] = finfo_file(finfo_open(FILEINFO_MIME_ENCODING), $this->file);
            $this->file_info['size'] = $stat[7];
            $this->file_info['size_string'] = $this->format_bytes($stat[7]);
            $this->file_info['atime'] = $stat[8];
            $this->file_info['mtime'] = $stat[9];
            $this->file_info['permission'] = substr(sprintf('%o', fileperms($this->file)), -4);
            $this->file_info['fileowner'] = getenv('USERNAME');
        }

        /**
         * @param int => $size = value in bytes to be formatted
         */
        private function format_bytes(int $size){
            $base = log($size, 1024);
            $suffixes = array('', 'KB', 'MB', 'GB', 'TB');  
            return round(pow(1024, $base-floor($base)), 2).''.$suffixes[floor($base)];
        }
    }
